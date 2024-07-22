<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
        $emails = Contact::get();
        $messages = Contact::where('readable', 0)->take(3)->get();
        return view('dashAdmin.contactMail', compact('emails', 'messages'));
    }

    public function show(string $id)
    {
        $email = Contact::findOrFail($id);
        $messages = Contact::where('readable', 0)->take(3)->get();
        Contact::where('id', $id)->update(['readable' => 1]);
        return view('dashAdmin.showEmail', compact('email', 'messages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'message' => 'required|string|max:250',
        ]);

        Contact::create($data);

        return 'add';
    }

    public function sendMail(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to('recipient@example.com')->send(new ContactMail($data));

        //return back()->with('success', 'Your message has been sent successfully!');
        return "mail send";
    }
    public function markAsRead(Request $request, $id)
{
    $contact = Contact::findOrFail($id);
    $contact->update(['readable' => 1]);

    return response()->json(['success' => true]);
}
}
