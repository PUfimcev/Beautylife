<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'])->except('store', 'getUnsubscribeForm', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'email' => 'unique:subscribes,email|email:filter',
        ]);

        $params = $validated;
        if(Auth::check()) $params['name'] = Auth::user()->name;
        Subscription::create($params);

        return redirect()->back()->with('status', 'You are subscribed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return to_route('index');
    }

    /**
     * Show the form for unsubcribing.
     */
    public function getUnsubscribeForm(Subscription $subscription)
    {

        return view('components.unsubscribe-form', compact('subscription'));

    }
}
