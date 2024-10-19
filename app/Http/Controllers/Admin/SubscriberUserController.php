<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Models\SubscriberUser;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubscriberUserController extends Controller
{
    public function getAllSubscriberUser(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriberUser::orderByDesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    if (empty($row->name)) {
                        return '<span class="badge text-bg-danger">Empty</span>';
                    } else {
                        return $row->name;
                    }
                })
                ->addColumn('action', function ($row) {
                    // Dynamically create the Edit and Delete buttons with $row->id
                    $deleteUrl = route('admin.delete_subscriber_user', $row->id);
                    return '<a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('layouts.admin.subscriber-user.all-subscriber-user');
    }

    public function deleteSubscriberUser($id)
    {
        $user = SubscriberUser::findOrFail($id);
        $user->delete();
        FlashMessage::flash('success', 'User deleted successfully.');
        return redirect()->back();
    }
}
