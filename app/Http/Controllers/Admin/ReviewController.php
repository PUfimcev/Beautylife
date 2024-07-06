<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'])->except('create', 'store');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::orderBy('edited','asc')->orderBy('updated_at','desc')->paginate(5);

        return view('admin.pages.reviews.reviews-index', compact('reviews'))->with('i', (request()->input('page', 1)-1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.reviews.review-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {

        $params = $request->only('reviewer_name', 'evaluation', 'review_content');

        if ($request->hasFile('reviewFile')) $params['reviewer_image_route'] = $this->setFilePath($request->file('reviewFile'));

        Review::create($params);

        return to_route('index')->with('status', 'Thank you very much!')->with('status2', 'Review created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('admin.pages.reviews.review-show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.pages.reviews.review-create-form', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $params = $request->all();

        $params['edited'] = 1;

        $review->update($params);

        return to_route('admin.reviews.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {

        $getFileRoute = Str::of($review->reviewer_image_route)->after('/'.config('app.name').'/storage/app/');
        if($getFileRoute !== '' && Storage::disk('local')->exists($getFileRoute)) Storage::disk('local')->delete($getFileRoute);

        $review->delete();

        return to_route('admin.reviews.index')->with('status', 'Successfully deleted!');

    }

    public function setFilePath($file)
    {
        if(!Storage::disk('local')->exists('review_photos')) {
            Storage::disk('local')->makeDirectory('review_photos', 0775, true); //creates directory
        }

        $path = Storage::disk('local')->put('review_photos', $file);

        return  $path;
    }
}
