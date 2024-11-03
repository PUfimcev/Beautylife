<?php

namespace App\Http\Controllers\Admin;

use App\Models\SkinType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkinTypeRequest;

class SkinTypeController extends Controller
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

            $skintypes = SkinType::orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $skintypes = SkinType::orderBy('name','asc')->paginate(10);
        } else {
            $skintypes = SkinType::orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.skintypes.skintypes-index', compact('skintypes'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.skintypes.skintype-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkinTypeRequest $request)
    {
        $params = $request->all();

        $params['code'] = Str::snake(Str::lower($request->input('code')));
        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        SkinType::create($params);

        return to_route('admin.skintypes.index')->with('status', 'SkinType created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SkinType $skintype)
    {

        return view('admin.pages.skintypes.skintype-show', compact('skintype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkinType $skintype)
    {
        return view('admin.pages.skintypes.skintype-create-form', compact('skintype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkinTypeRequest $request, SkinType $skintype)
    {

        $params = $request->all();
        $params['code'] = Str::snake(Str::lower($request->input('code')));
        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        $skintype->update($params);

        return to_route('admin.skintypes.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkinType $skintype)
    {

        $skintype->delete();

        return to_route('admin.skintypes.index')->with('status', 'Successfully deleted!');
    }

    // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex()
    {

        if(session('locale') == 'en'){

            $skintypes = SkinType::onlyTrashed()->orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $skintypes = SkinType::onlyTrashed()->orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.skintypes.skintypes-index', compact('skintypes'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(SkinType $skintype)
    {
        return view('admin.pages.skintypes.skintype-show', compact('skintype'))->with('archive','true')->with('i', 1);
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(SkinType $skintype)
    {
        $skintype->restore();

        return to_route('admin.skintype_archive')->with('status', 'Skintype restored!');
    }

    /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(SkinType $skintype)
    {

        $skintype->forceDelete();

        return to_route('admin.skintype_archive')->with('status', 'Completely removed!');
    }

}
