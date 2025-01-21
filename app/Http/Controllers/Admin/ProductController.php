<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Agerange;
use App\Models\Category;
use App\Models\Consumer;
use App\Models\Property;
use App\Models\SkinType;
use App\Models\Subcategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Traits\Transliteratable;
use App\Models\ProductDescription;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use Transliteratable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsQuery = Product::query();

        if(session('locale') == 'en'){

            $productsQuery = $productsQuery->orderBy('name_en','asc');

        } else if (session('locale') == 'ru'){

            $productsQuery = $productsQuery->orderBy('name','asc');
        } else {
            $productsQuery = $productsQuery->orderBy('name','asc');
        }

        if($request->input('findData') !== null)  $productsQuery = $productsQuery->search($request->input('findData'));


            $products = $productsQuery->paginate(10);


        return view('admin.pages.products.products-index', compact('products'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category = null)
    {

        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $skinTypes = $this->getSkinTypes();
        $agerange = $this->getAgerange();
        $consumers = $this->getConsumers();

        if(is_null($category)){

            return view('admin.pages.products.product-create-form', compact('categories'));

        } else {

            $subcategories = $category->subcategories;

            return view('admin.pages.products.product-create-form', compact('category','subcategories', 'brands', 'skinTypes', 'agerange', 'consumers'));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $productsTableParams = $request->only('slug', 'slug_en', 'code', 'name', 'name_en', 'price', 'reduced_price', 'amount', 'new', 'top');

        $productsTableParams['slug'] = self::getTransliteration($request->input('name'));

        $productsTableParams['slug_en'] = $request->input('name_en');

        $product = Product::create($productsTableParams);

        $product = Product::findOrFail($product->id);

        $propertiesTableParams = $request->only('product_id','category_id','subcategory_id','brand_id','skin_type_id','agerange_id','consumer_id');

        $property = new Property($propertiesTableParams);

        $productDescriptionsTableParams = $request->only('about', 'about_en', 'description', 'description_en', 'application', 'application_en', 'origin', 'origin_en', 'ingredients', 'ingredients_en');

        $productDescription = new ProductDescription($productDescriptionsTableParams);

        $product->property()->save($property);

        $product->productDescription()->save($productDescription);

        if ($request->hasFile('productFiles')) {

            foreach($request->productFiles as $productImage){

                if($productImage->isValid()){

                    $productImageTable['route'] = $this->setFilePath($productImage);
                }

                $productImages[] = new ProductImage($productImageTable);

            };

            $product->productImages()->saveMany($productImages);
        }


        return to_route('admin.products.index')->with('status', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.pages.products.product-show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = $this->getBrands();
        $skinTypes = $this->getSkinTypes();
        $agerange = $this->getAgerange();
        $consumers = $this->getConsumers();

        return view('admin.pages.products.product-create-form', compact('product', 'brands', 'skinTypes', 'agerange', 'consumers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productsTableParams = $request->only('slug', 'slug_en', 'code', 'name', 'name_en', 'price', 'reduced_price', 'amount', 'new', 'top');

        $productsTableParams['new'] = $request->input('new') ?? null;

        $productsTableParams['top'] = $request->input('top') ?? null;

        $productsTableParams['slug'] = self::getTransliteration($request->input('name'));

        $productsTableParams['slug_en'] = $request->input('name_en');

        $product->update($productsTableParams);

        $propertiesTableParams = $request->only('product_id','category_id','subcategory_id','brand_id','skin_type_id','agerange_id','consumer_id');

        $productDescriptionsTableParams = $request->only('about', 'about_en', 'description', 'description_en', 'application', 'application_en', 'origin', 'origin_en', 'ingredients', 'ingredients_en');


        $product->property()->update($propertiesTableParams);

        $product->productDescription()->update($productDescriptionsTableParams);

        if ($request->hasFile('productFiles')) {


            foreach($request->productFiles as $productImage){

                if($productImage->isValid()){

                    $productImageTable['route'] = $this->setFilePath($productImage);
                }

                $productImages[] = new ProductImage($productImageTable);

            };

            $product->productImages()->saveMany($productImages);
        }


        return to_route('admin.products.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('admin.products.index')->with('status', 'Successfully deleted!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPictures(Request $request, Product $product)
    {
        if($request->has('productPictures')){

            foreach($request->productPictures as $image){

                $imgRoute = $product->GetPicture($image)->route;

                if(Storage::exists($imgRoute)) Storage::delete($imgRoute);

                ProductImage::destroy($image);

            }

        }

        return to_route('admin.products.edit', $product)->with('status', 'Successfully deleted!');
    }

    /**
     * Get the route of file storage.
     */
    public function setFilePath($file)
    {
        if(!Storage::exists('product_image')) {
            Storage::makeDirectory('product_image', 0775, true); //creates directory
        }

        $path = Storage::put('product_image', $file);

        return  $path;
    }


    public function getCategories(){

            $categories = Category::all();

        return $categories;
    }

    public function getBrands(){

        $brands = Brand::all();

        return $brands;
    }

    public function getSkinTypes(){

        $skinTypes = SkinType::all();

        return $skinTypes;
    }

    public function getAgerange(){

        $agerange = Agerange::all();

        return $agerange;
    }

    public function getConsumers(){

        $consumers = Consumer::all();

        return $consumers;
    }


    // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex(Request $request)
    {

        $productsQuery = Product::query()->onlyTrashed();

        if(session('locale') == 'en'){

            $products = $productsQuery->orderBy('name_en','asc');

        } else if (session('locale') == 'ru'){

            $products = $productsQuery->orderBy('name','asc');
        }

            if($request->input('findData') !== null)  $productsQuery = $productsQuery->search($request->input('findData'));

            $products = $productsQuery->paginate(10);


        return view('admin.pages.products.products-index', compact('products'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Product $product)
    {

        return view('admin.pages.products.product-show', compact('product'))->with('archive','true');
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(Product $product)
    {

        $product->restore();

        return to_route('admin.products.index')->with('status', 'Product\'s restored!');
    }

        /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(Product $product)
    {

        foreach($product->productImages as $imageRoute){

            $imgRoute = $imageRoute->route;

            if(Storage::exists($imgRoute)) Storage::delete($imgRoute);

        }

        $product->forceDelete();

        return to_route('admin.products.index')->with('status', 'Completely removed!');
    }

}
