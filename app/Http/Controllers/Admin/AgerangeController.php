<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agerange;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgerangeRequest;

class AgerangeController extends Controller
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

            $ageranges = Agerange::orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $ageranges = Agerange::orderBy('name','asc')->paginate(10);
        } else {
            $ageranges = Agerange::orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.ageranges.ageranges-index', compact('ageranges'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.ageranges.agerange-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgerangeRequest $request)
    {

        $params = $request->all();

        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        Agerange::create($params);

        return to_route('admin.ageranges.index')->with('status', 'Age range created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agerange $agerange)
    {
        return view('admin.pages.ageranges.agerange-show', compact('agerange'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agerange $agerange)
    {
        return view('admin.pages.ageranges.agerange-create-form', compact('agerange'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgerangeRequest $request, Agerange $agerange)
    {
        $params = $request->all();

        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        $agerange->update($params);

        return to_route('admin.ageranges.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agerange $agerange)
    {
        $agerange->delete();

        return to_route('admin.ageranges.index')->with('status', 'Successfully deleted!');
    }

   // Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex()
    {

        if(session('locale') == 'en'){

            $ageranges = Agerange::onlyTrashed()->orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $ageranges = Agerange::onlyTrashed()->orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.ageranges.ageranges-index', compact('ageranges'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Agerange $agerange)
    {
        return view('admin.pages.ageranges.agerange-show', compact('agerange'))->with('archive','true')->with('i', 1);
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(Agerange $agerange)
    {
        $agerange->restore();

        return to_route('admin.agerange_archive')->with('status', 'Age range restored!');
    }

    /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(Agerange $agerange)
    {

        $agerange->forceDelete();

        return to_route('admin.agerange_archive')->with('status', 'Completely removed!');
    }
}
