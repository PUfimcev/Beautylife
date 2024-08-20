<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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
        $brands = Brand::orderBy('brand_name','asc')->paginate(10);

        return view('admin.pages.brands.brands-index', compact('brands'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.brands.brand-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $params = $request->all();
        $params['slug'] = $request->input('brand_name');

        if ($request->hasFile('brandFile')) $params['brand_image_route'] = $this->setFilePath($request->file('brandFile'));


        Brand::create($params);

        return to_route('admin.brands.index')->with('status', 'Brand created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.pages.brands.brand-show', compact('brand'));
    }

    /**
     * Show the form for editing the randspecified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.pages.brands.brand-create-form', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $params = $request->all();

        $params['slug'] = $request->input('brand_name');

        if ($request->hasFile('brandFile')) {

            if($brand->brand_image_route !== null && Storage::exists($brand->brand_image_route)) Storage::delete($brand->brand_image_route);

            $params['brand_image_route'] = $this->setFilePath($request->file('brandFile'));
        }

        $brand->update($params);

        return to_route('admin.brands.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($brand->brand_image_route !== null && Storage::exists($brand->brand_image_route)) Storage::delete($brand->brand_image_route);

        $brand->delete();

        return to_route('admin.brands.index')->with('status', 'Successfully deleted!');
    }

    /**
     * Get the route of file storage.
     */
    public function setFilePath($file)
    {
        if(!Storage::exists('brand_logo')) {
            Storage::makeDirectory('brand_logo', 0775, true); //creates directory
        }

        $path = Storage::put('brand_logo', $file);

        return  $path;
    }
}
