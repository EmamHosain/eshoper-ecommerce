<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// image intervention
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdminProfileController extends Controller
{
    public function getProfilePage()
    {
        $admin = Auth::guard('admin')->user();
        return view('layouts.admin.profile.admin-profile', [
            'admin' => $admin
        ]);
    }
    public function profileUpdateSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique(Admin::class)->ignore(Auth::guard('admin')->id())],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        // Fetch the authenticated user
        $admin = Auth::guard('admin')->user();

        // Handle the photo upload if a new photo is provided
        if ($request->hasFile('photo')) {
            if($admin->photo && file_exists(public_path($admin->photo))){
                unlink(public_path($admin->photo));
            }


            // Use image intervention for resizing and saving
            $image = $request->file('photo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/admin_profile_photo/' . $image_name));

            // Store image path in the database
            $validatedData['photo'] = 'upload/admin_profile_photo/' . $image_name;
            $admin->photo =  $validatedData['photo'];
        }

        // Update user details
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
      
        $admin->save();

        // Set success message
        FlashMessage::flash('success', 'Profile updated successfully.');
        // Redirect back with success message
        return redirect()->back();
    }
    public function changePasswordPage()
    {
        return view('layouts.admin.profile.change-password');
    }
    public function changePasswordSubmit(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:new_password']
        ]);

        // Get the authenticated user
        $admin = Auth::guard('admin')->user();


        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }


        if (Hash::check($request->new_password, $admin->password)) {
            return back()->withErrors(['new_password' => 'The new password cannot be the same as the current password.']);
        }

        // Update the password
        $admin->password = Hash::make($validatedData['new_password']);
        $admin->save();

        FlashMessage::flash('success', 'Password updated successfully.');
        return redirect()->back();
    }
}
