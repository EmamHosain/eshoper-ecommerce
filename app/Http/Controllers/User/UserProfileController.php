<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// image intervention
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserProfileController extends Controller
{
    public function userProfilePage()
    {
        $user = Auth::user();
        return view('layouts.user.backend.pages.user-profile', [
            'user' => $user
        ]);
    }

    public function changePasswordPage()
    {
        return view('layouts.user.backend.pages.change-password');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        // Update the user
        $user = User::find($id);
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
        ]);
        // FlashMessage::flash('success', 'Profile updated successfully.');
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updateProfileImage(Request $request, $id)
    {
        $validated = $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ]);



        $user = User::find($id);
        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }



            // Use image intervention for resizing and saving
            $image = $request->file('photo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/user_photo/' . $image_name));

            // Store image path in the database
            $validated['photo'] = 'upload/user_photo/' . $image_name;
        }




        // Update user's profile photo
        $user->update([
            'photo' => $validated['photo'] ?? $user->photo,
        ]);
        // FlashMessage::flash('success', 'Profile image updated successfully.');

        return redirect()->back()->with('success', 'Profile image updated successfully.');
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
        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }


        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'The new password cannot be the same as the current password.']);
        }

        // Update the password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
