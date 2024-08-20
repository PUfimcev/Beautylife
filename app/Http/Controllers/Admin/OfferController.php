<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\Transliteratable;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
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
    public function index()
    {
        $offers = Offer::latest()->paginate(10);

        return view('admin.pages.offers.offers-index', compact('offers'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $brands = $this->getBrands();

        $categories = $this->getCategories();

        $productGroups = $this->getProductGroups();

        return view('admin.pages.offers.offer-create-form',compact('brands', 'categories', 'productGroups'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {

        $params = $request->all();

        $params['slug'] = self::getTransliteration($request->input('title'));

        $params['slug_en'] = $request->input('title_en');

        if ($request->hasFile('offerFile')) $params['image_route'] = $this->setFilePath($request->file('offerFile'));

        $offer = Offer::create($params);

        if($request->input('offer_brand_type') !== null){

            $brands = Brand::find($request->input('offer_brand_type'));
            $offer->brands()->attach($brands);

        }

        return to_route('admin.offers.index')->with('status', 'Offer created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $brands = $offer->brands->map->brand_name;

        return view('admin.pages.offers.offer-show', compact('offer', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {

        $brands = $this->getBrands();

        $categories = $this->getCategories();

        $productGroups = $this->getProductGroups();

        return view('admin.pages.offers.offer-create-form',compact('offer','brands', 'categories', 'productGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, Offer $offer)
    {

        $params = $request->all();

        $params['slug'] = self::getTransliteration($request->input('title'));

        $params['slug_en'] = $request->input('title_en');

        if ($request->hasFile('offerFile')) {

            if($offer->image_route !== null && Storage::exists($offer->image_route)) Storage::delete($offer->image_route);

            $params['image_route'] = $this->setFilePath($request->file('offerFile'));
        }

        $offer->update($params);

        if($request->input('offer_brand_type') !== null){

            if($offer->brands){

                $offer->brands()->detach($offer->brands);

            }

            $brands = Brand::find($request->input('offer_brand_type'));
            $offer->brands()->attach($brands);

        }

        return to_route('admin.offers.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {

        $offer->delete();

        return to_route('admin.offers.index')->with('status', 'Successfully deleted!');
    }


    /**
     * Get the route of file storage.
     */
    public function setFilePath($file)
    {
        if(!Storage::exists('offer_image')) {
            Storage::makeDirectory('offer_image', 0775, true); //creates directory
        }

        $path = Storage::put('offer_image', $file);

        return  $path;
    }

    public function getBrands(){

        $brands = Brand::all();

        return $brands;
    }

    public function getCategories(){

        // $brands = Category::all();

        $categories = [];

        return $categories;
    }

    public function getProductGroups(){

        // $brands = Category::all();

        $productGroups = [];

        return $productGroups;
    }

    // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex()
    {
        $offers = Offer::onlyTrashed()->latest()->paginate(10);


        return view('admin.pages.offers.offers-index', compact('offers'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');
    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Offer $offer)
    {
        $brands = $offer->brands->map->brand_name;

        return view('admin.pages.offers.offer-show', compact('offer','brands'))->with('archive','true');
    }


    /**
     * Remove finally the specified resource from storage.
     */
    public function restoreArchive(Offer $offer)
    {

        $offer->restore();

        return to_route('admin.offers.index')->with('status', 'Offer\'s restored!');
    }

    /**
     * Remove finally the specified resource from storage.
     */
    public function destroyArchive(Offer $offer)
    {

        if($offer->image_route !== null && Storage::exists($offer->image_route)) Storage::delete($offer->image_route);


        if($offer->brands){

            $offer->brands()->detach($offer->brands);

        }

        $offer->forceDelete();

        return to_route('admin.offers_archive')->with('status', 'Completely removed!');
    }



}
