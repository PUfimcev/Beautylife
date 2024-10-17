<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

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
    public function index()
    {

        if(session('locale') == 'en'){

            $categories = Category::orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $categories = Category::orderBy('name','asc')->paginate(10);
        } else {
            $categories = Category::orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.categories.categories-index', compact('categories'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.categories.category-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        dd($request->all());
        $params = $request->all();


        if ($request->hasFile('categoryFile')) $params['image_route'] = $this->setFilePath($request->file('categoryFile'));

        $params['code'] = Str::snake(Str::lower($request->input('code')));
        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        Category::create($params);

        return to_route('admin.categories.index')->with('status', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        if(session('locale') == 'en'){
            $subcategories = $category->subcategories()->orderBy('name_en','asc')->get();
        }

            $subcategories = $category->subcategories()->orderBy('name','asc')->get();

        return view('admin.pages.categories.category-show', compact('category', 'subcategories'))->with('i', 1);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.pages.categories.category-create-form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        $params = $request->all();

        // dd( $params);

        if ($request->hasFile('categoryFile')) {

            if(!Storage::exists('category_image')) {
                Storage::makeDirectory('category_image', 0775, true); //creates directory
            }

            if($category->image_route !== null && Storage::exists($category->image_route)) Storage::delete($category->image_route);

            $params['image_route'] = $this->setFilePath($request->file('categoryFile'));
        }

        $params['code'] = Str::snake(Str::lower($request->input('code')));
        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        $category->update($params);

        return to_route('admin.categories.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->subcategories()->delete();
        $category->delete();

        return to_route('admin.categories.index')->with('status', 'Successfully deleted!');
    }

    /**
     * Get the route of file storage.
     */
    public function setFilePath($file)
    {
        if(!Storage::exists('category_image')) {
            Storage::makeDirectory('category_image', 0775, true); //creates directory
        }

        $path = Storage::put('category_image', $file);

        return  $path;
    }


    // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex()
    {

        if(session('locale') == 'en'){

            $categories = Category::onlyTrashed()->orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $categories = Category::onlyTrashed()->orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.categories.categories-index', compact('categories'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Category $category)
    {
        if(session('locale') == 'en'){

            $subcategories = $category->subcategories()->onlyTrashed()->orderBy('name_en','asc')->get();

        }

            $subcategories = $category->subcategories()->onlyTrashed()->orderBy('name','asc')->get();



        return view('admin.pages.categories.category-show', compact('category', 'subcategories'))->with('archive','true')->with('i', 1);
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(Category $category)
    {
        $category->subcategories()->restore();
        $category->restore();

        return to_route('admin.category_archive')->with('status', 'Category\'s restored!');
    }

    /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(Category $category)
    {
        if($category->image_route !== null && Storage::exists($category->image_route)) Storage::delete($category->image_route);

        $category->forceDelete();

        return to_route('admin.category_archive')->with('status', 'Completely removed!');
    }


}



