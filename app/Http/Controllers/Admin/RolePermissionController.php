<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    public function addRolePermission()
    {
        $roles = Role::latest()->get();
        $permissions = Permission::get();
        $groups = Admin::getPermissionGroups();

        return view('layouts.admin.role-permission.role-permission-setup', [
            'permissions' => $permissions,
            'roles' => $roles,
            'permission_groups' => $groups
        ]);
    }

    public function addUserAndRole()
    {
        $users = Admin::get();
        $roles = Role::get();
        return view('layouts.admin.role-permission.add-user-and-role', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function createUserForRole(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
        ]);
        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Create a new user
        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        // Flash success message and redirect
        FlashMessage::flash('success', 'User created successfully.');
        return redirect()->back();
    }

    public function assingRoleToUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user' => 'required|exists:admins,id',
            'role' => 'required|array', // Validate that role is an array
            'role.*' => 'exists:roles,id', // Validate each role ID
        ]);

        // Find the user (admin) using the provided ID
        $user = Admin::findOrFail($request->input('user'));

        // Assign multiple roles to the user
        foreach ($request->input('role') as $roleId) {
            // Find the role using the role ID and guard for 'admin'
            $role = Role::where('id', $roleId)->where('guard_name', 'admin')->first();
            // Check if the role exists for the 'admin' guard
            if ($role) {
                $user->assignRole($role->name); // Assign the role by its name
            }
        }
        // Flash success message and redirect back
        FlashMessage::flash('success', 'User & roles assigned successfully.');
        return redirect()->back();
    }





    public function assingPermissionToRole(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'role' => 'required|exists:roles,id', // Check if the role exists
            'permission' => 'required|array' // Ensure permission is an array
        ]);

        if ($validator->fails()) {
            FlashMessage::flash('error', 'Select Role & Permission.');
            return redirect()->back();
        }
        // Find the role by ID
        $role = Role::find($request->input('role'));
        $permissions = Permission::whereIn('id', $request->input('permission'))->pluck('name')->toArray();
        // Sync the provided permissions to the role
        $role->syncPermissions($permissions);
        FlashMessage::flash('success', 'Permission setup successfully.');
        return redirect()->back();
    }




}
