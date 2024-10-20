<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function getAllRole(Request $request)
    {
        if ($request->ajax()) {
            // Fetch roles with their associated permissions
            $data = Role::with('permissions')->orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function ($row) {
                    // Check if the permissions relationship has data and handle it
                    if ($row->permissions->isNotEmpty()) {
                        return implode(" ", $row->permissions->pluck('name')->map(function ($name) {
                            return '<span class="badge text-bg-primary">' . htmlspecialchars($name) . '</span>';
                        })->toArray());
                    } else {
                        return 'No Permissions';
                    }


                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.edit_role', $row->id);
                    $deleteUrl = route('admin.delete_role', $row->id);
                    return '<div class="d-flex justify-content-between align-items-center">
                                <a href="' . $editUrl . '" class="btn btn-success me-2">Edit</a>
                                <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>
                            </div>';
                })

                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        // Return the view if the request is not AJAX
        return view('layouts.admin.role.all-role');
    }

    public function storeRole(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin',
        ]);

        FlashMessage::flash('success', 'Role creaed successfully.');
        return redirect()->route('admin.get_all_role');
    }

    public function editRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        // return $role;
        $all_roles = Role::get();
        $groups = Admin::getPermissionGroups();
        $permissions = Permission::get();

        $permision_ids = $role->permissions->pluck('id')->toArray();


        return view('layouts.admin.role.edit-role', [
            'role' => $role,
            'roles' => $all_roles,
            'permission_groups' => $groups,
            'permissions' => $permissions,
            'permision_ids' => $permision_ids
        ]);
    }
    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id // Ensure name is unique except for the current role
        ]);

        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'admin',
        ]);

        FlashMessage::flash('success', 'Role updated successfully.');
        return redirect()->route('admin.get_all_role');
    }

    public function updateRoleAndPermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'role' => 'required|exists:roles,id', // Check if the role exists
            'permission' => 'required|array' // Ensure permission is an array
        ]);

        if ($validator->fails()) {
            FlashMessage::flash('error', 'Select Role & Permission.');
            return redirect()->back();
        }
  
        $permissions = Permission::whereIn('id', $request->input('permission'))->pluck('name')->toArray();
        // Sync the provided permissions to the role
        $role->syncPermissions($permissions);
        FlashMessage::flash('success', 'Permission setup successfully.');
        return redirect()->back();


    }


    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        FlashMessage::flash('success', 'Role deleted successfully.');
        return redirect()->route('admin.get_all_role');
    }



}
