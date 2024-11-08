<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;

class SubcategoryController extends Controller
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
    public function index(Category $category)
    {

        if(session('locale') == 'en'){

            $subcategories = $category->subcategories()->orderBy('name_en','asc')->paginate(10);

        }

        $subcategories = $category->subcategories()->orderBy('name','asc')->paginate(10);

        return view('admin.pages.categories.subcategories.subcategories-index', compact('subcategories', 'category'))->with('i', (request()->input('page', 1)-1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        return view('admin.pages.categories.subcategories.subcategory-create-form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Category $category, SubcategoryRequest $request)
    {
        $params = $request->all();

        $params['category_id'] = $category->id;
        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));

        Subcategory::create($params);

        return to_route('admin.subcategories.index', $category)->with('status', 'Subcategory created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Subcategory $subcategory)
    {
        return view('admin.pages.categories.subcategories.subcategory-show', compact('category', 'subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Subcategory $subcategory)
    {
        return view('admin.pages.categories.subcategories.subcategory-create-form', compact('category','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, SubcategoryRequest $request, Subcategory $subcategory)
    {

        $params = $request->all();

        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));

        $subcategory->update($params);

        return to_route('admin.subcategories.index', $category)->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Subcategory $subcategory)
    {
        $subcategory->delete();

        return to_route('admin.subcategories.index', $category)->with('status', 'Successfully deleted!');
    }


    // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex(Category $category)
    {

        if(session('locale') == 'en'){

            $subcategories = $category->subcategories()->onlyTrashed()->orderBy('name_en','asc')->paginate(10);

        }

            $subcategories = $category->subcategories()->onlyTrashed()->orderBy('name','asc')->paginate(10);


        return view('admin.pages.categories.subcategories.subcategories-index', compact('subcategories', 'category'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Category $category, Subcategory $subcategory)
    {
        return view('admin.pages.categories.subcategories.subcategory-show', compact('subcategory', 'category'))->with('archive','true');
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(Category $category, Subcategory $subcategory)
    {

        if($category->trashed())  $category->restore();

        $subcategory->restore();

        return to_route('admin.subcategory_archive', $category)->with('status', 'Subcategory\'s restored!');
    }

    /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(Category $category, Subcategory $subcategory)
    {

        $subcategory->forceDelete();

        return to_route('admin.subcategory_archive', $category)->with('status', 'Completely removed!');
    }


        /**
     * Display a listing of the resource.
     */
    public function archiveCategoryGetSubcategories(Category $category)
    {

        // if(session('locale') == 'en'){

        //     $subcategories = Category::onlyTrashed()->subcategories()->orderBy('name_en','asc')->paginate(10);

        // }

        // // dd($category->id);


        // $subcategories = Subcategory::where('category_id', $category->id)->orderBy('name','asc')->paginate(10);

        // return view('admin.pages.categories.subcategories.subcategories-index', compact('subcategories', 'category'))->with('i', (request()->input('page', 1)-1) * 10);
    }
}
