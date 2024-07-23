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
        $messages = Contact::all();
        return view('dashAdmin.contact', compact('messages'));
    }
    
    public function show(string $id)
    {
        $email = Contact::findOrFail($id);
        return view('dashAdmin.showEmail', compact('email'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);
        
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'readable' => false,
        ]);
    
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
    public function sendMessage(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $message = new Contact();
    $message->name = $request->input('name');
    $message->message = $request->input('message');
    $message->save();

    $messages = Contact::where('readable', 0)->get();
    $messagesCount = $messages->count();

    return redirect()->route('dashAdmin')->with([
        'messages' => $messages,
        'messagesCount' => $messagesCount
    ]);
}
    public function destroy($id) 
    {
        Contact::destroy($id);
        return redirect()->route('admin.contact')->with('success', 'Message deleted successfully.');
    }

}