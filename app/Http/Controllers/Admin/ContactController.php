<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Models\AdminInformation;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function allContact(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::latest();


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('admin.delete_contact', $row->id);
                    $viewUrl = route('admin.view_contact', $row->id);
                    return '<a href="' . $viewUrl . '" class="btn btn-primary">View</a>
                    <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->addColumn('message', function ($row) {
                    return Str::limit($row->message, 20);
                })
                ->rawColumns(['action', 'message'])
                ->make(true);
        }
        return view('layouts.admin.contact.all-contact');
    }

    public function viewContact($id)
    {
        $contact = Contact::findOrFail($id);
        return view('layouts.admin.contact.view-contact', [
            'contact' => $contact
        ]);
    }
    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        FlashMessage::flash('success', 'Contact deleted successfully.');
        return redirect()->route('admin.all_contact');
    }

    public function editContactPage()
    {
        $contact = AdminInformation::first();
        return view('layouts.admin.contact.edit-contact-page', [
            'contact' => $contact
        ]);
    }


    public function updateContactPageInfo(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'contact_heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Use updateOrCreate method
        AdminInformation::updateOrCreate(
            ['email' => $validatedData['email']],
            [   // Fields to update or create
                'contact_heading' => $validatedData['contact_heading'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
            ]
        );
        FlashMessage::flash('success', 'Content updated successfully.');

        // Return a success response (redirect or message)
        return redirect()->back();
    }

}
