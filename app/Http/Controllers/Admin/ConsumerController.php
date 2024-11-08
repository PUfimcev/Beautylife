<?php

namespace App\Http\Controllers\Admin;

use App\Models\Consumer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsumerRequest;

class ConsumerController extends Controller
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

            $consumers = Consumer::orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $consumers = Consumer::orderBy('name','asc')->paginate(10);
        } else {
            $consumers = Consumer::orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.consumers.consumers-index', compact('consumers'))->with('i', (request()->input('page', 1)-1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.consumers.consumer-create-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsumerRequest $request)
    {
        $params = $request->all();

        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        Consumer::create($params);

        return to_route('admin.consumers.index')->with('status', 'Consumer created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumer $consumer)
    {
        return view('admin.pages.consumers.consumer-show', compact('consumer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumer $consumer)
    {
        return view('admin.pages.consumers.consumer-create-form', compact('consumer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsumerRequest $request, Consumer $consumer)
    {
        $params = $request->all();

        $params['name'] = Str::ucfirst($request->input('name'));
        $params['name_en'] = Str::ucfirst($request->input('name_en'));


        $consumer->update($params);

        return to_route('admin.consumers.index')->with('status', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumer $consumer)
    {
        $consumer->delete();

        return to_route('admin.consumers.index')->with('status', 'Successfully deleted!');
    }

// Archive process

    /**
     * Display a listing of the archive resource.
     */
    public function archiveIndex()
    {

        if(session('locale') == 'en'){

            $consumers = Consumer::onlyTrashed()->orderBy('name_en','asc')->paginate(10);

        } else if (session('locale') == 'ru'){

            $consumers = Consumer::onlyTrashed()->orderBy('name','asc')->paginate(10);
        }

        return view('admin.pages.consumers.consumers-index', compact('consumers'))->with('i', (request()->input('page', 1)-1) * 10)->with('archive','true');

    }

    /**
     * Display the specified resource.
     */
    public function showArchive(Consumer $consumer)
    {
        return view('admin.pages.consumers.consumer-show', compact('consumer'))->with('archive','true')->with('i', 1);
    }


    /**
     * Restore the specified resource from archive.
     */
    public function restoreArchive(Consumer $consumer)
    {
       $consumer->restore();

        return to_route('admin.consumer_archive')->with('status', 'Age range restored!');
    }

    /**
     * Remove finally the specified resource.
     */
    public function destroyArchive(Consumer $consumer)
    {

       $consumer->forceDelete();

        return to_route('admin.consumer_archive')->with('status', 'Completely removed!');
    }
}
