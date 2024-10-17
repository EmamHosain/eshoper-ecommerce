<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
}
