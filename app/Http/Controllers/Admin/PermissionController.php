<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function getAllPermission(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::orderByDesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('layouts.admin.permission.all-permission');
    }
}
