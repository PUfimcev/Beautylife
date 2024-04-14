<?php

namespace App\Http\Controllers\Admin;

use App\Models\Callback;
use Illuminate\View\View;
use App\Traits\PreviousUrl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CallbackRequest;

class CallbackController extends Controller
{
    use PreviousUrl;

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
    public function index(): View
    {
        $callbacks = Callback::latest()->paginate(10);

        return view('admin.pages.callbacks', compact('callbacks'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->getPreviousUrl();

        return view('components.callback_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CallbackRequest $request)
    {
        Callback::create($request->all());

        if(session()->has('prevUrl')) {

            return redirect(session()->get('prevUrl'))->with('status', 'Thank you very much!')->with('status2', 'We\'ll call you back as soon as possible!');
        } else {
            return to_route('index')->with('status', 'Thank you very much!')->with('status2', 'We\'ll call you back as soon as possible!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Callback $callback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Callback $callback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Callback $callback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Callback $callback)
    {
        $callback->delete();

        return to_route('callbacks.index')->with('status', 'Contact is removed!');
    }
}
