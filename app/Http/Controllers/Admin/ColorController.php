<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Helper\FlashMessage;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Color::orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.edit_color', $row->id);
                    $deleteUrl = route('admin.delete_color', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.admin.color.all-color');
    }

    public function add()
    {
        return view('layouts.admin.color.add-color');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'color_name' => 'required|string|max:255|unique:colors,color_name',
        ]);

        Color::create($validated);

        FlashMessage::flash('success', 'Color created successfully.');
        return redirect()->route('admin.all_color');
    }

    public function edit(Color $color)
    {
        return view('layouts.admin.color.edit-color', ['color' => $color]);
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'color_name' => ['required', 'string', 'max:255', Rule::unique(Color::class)->ignore($color->id)],
        ]);

        // for data comparision
       $oldColor = $color->replicate();

        $color->update($validated);

        // is color updated flash message will be show
        if($oldColor->isDirty()){
            FlashMessage::flash('success', 'Color updated successfully.');
        }
        return redirect()->route('admin.all_color');
    }

    public function delete(Color $color)
    {
        $color->delete();
        FlashMessage::flash('success', 'Color deleted successfully.');
        return redirect()->back();
    }
}
