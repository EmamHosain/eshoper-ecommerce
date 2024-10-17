<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        return view('pages.frontend.contact-us');
    }

    public function contactSubmit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the validated data in the contacts table
        Contact::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ]);

        // Set a success flash message
        FlashMessage::flash('success', 'Your message has been submitted successfully.');
        // Redirect back to the form or another page
        return redirect()->back();
    }

}
