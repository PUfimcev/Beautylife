<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
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
        $blogs = Blog::orderBy('updated_at','desc')->paginate(6);

        return view('admin.pages.blogs.blogs-index', compact('blogs'))->with('i', (request()->input('page', 1)-1) * 6);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.pages.blogs.blog-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {

        $params = $request->all();

        $params['slug'] = Str::slug($request->input('slug'));

        if ($request->hasFile('blogFile')) $params['blog_image_route'] = $this->setFilePath($request->file('blogFile'));

        Blog::create($params);

        return to_route('admin.blogs.index')->with('status', 'Blog created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {

        return view('admin.pages.blogs.blog-show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

        return view('admin.pages.blogs.blog-create-form', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {

        $params = $request->all();

        if($blog->slug !== Str::slug($request->input('slug'))) $params['slug'] = Str::slug($request->input('slug'));

        if ($request->hasFile('blogFile')) {

            if($blog->blog_image_route !== null && Storage::exists($blog->blog_image_route)) Storage::delete($blog->blog_image_route);

            $params['blog_image_route'] = $this->setFilePath($request->file('blogFile'));
        }

        $blog->update($params);

        return to_route('admin.blogs.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {

        if($blog->blog_image_route !== null && Storage::exists($blog->blog_image_route)) Storage::delete($blog->blog_image_route);

        $blog->delete();

        return to_route('admin.blogs.index')->with('status', 'Successfully deleted!');
    }

    /**
     * Get the route of file storage.
     */
    public function setFilePath($file)
    {
        if(!Storage::exists('blog_pictures')) {
            Storage::makeDirectory('blog_pictures', 0775, true); //creates directory
        }

        $path = Storage::put('blog_pictures', $file);

        return  $path;
    }
}
