<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
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
    public function index(): View
    {
        $messages = Message::latest()->paginate(10);

        return view('admin.pages.messages.index', compact('messages'))->with('i', (request()->input('page', 1)-1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.messages.create_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        Message::create($request->all());

        return to_route('admin.messages.index')->with('status', 'Message created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $email_message = $message;

        return view('admin.pages.messages.show_message', compact('email_message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        $email_message = $message;

        return view('admin.pages.messages.create_form', compact('email_message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, Message $message)
    {

        $message->update($request->all());

        return to_route('admin.messages.index')->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return to_route('admin.messages.index');
    }
}
