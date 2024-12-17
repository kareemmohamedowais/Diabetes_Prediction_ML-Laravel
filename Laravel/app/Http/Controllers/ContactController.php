<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Send email
        Mail::to($request->email)->send(new ContactMail($details));

        // Redirect with success message
        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function showForm()
    {
        return view('contact');
    }
}
