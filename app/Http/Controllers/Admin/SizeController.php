<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Helper\FlashMessage;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Size::orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.edit_size', $row->id);
                    $deleteUrl = route('admin.delete_size', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.admin.size.all-size');
    }

    public function add()
    {
        return view('layouts.admin.size.add-size');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'size_name' => 'required|string|max:255|unique:sizes,size_name',
        ]);

        Size::create($validated);

        FlashMessage::flash('success', 'Size created successfully.');
        return redirect()->route('admin.all_size');
    }

    public function edit(Size $size)
    {
        return view('layouts.admin.size.edit-size', ['size' => $size]);
    }

    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'size_name' => ['required', 'string', 'max:255', Rule::unique(Size::class)->ignore($size->id)],
        ]);

        $size->update($validated);

        FlashMessage::flash('success', 'Size updated successfully.');
        return redirect()->route('admin.all_size');
    }

    public function delete(Size $size)
    {
        $size->delete();

        FlashMessage::flash('success', 'Size deleted successfully.');
        return redirect()->back();
    }
}
