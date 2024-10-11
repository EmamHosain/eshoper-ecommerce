<?php

namespace App\Http\Controllers\User\Auth;
use App\Models\User;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Password;

class UserAuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.user.auth.login');
    }
    public function loginSubmit(LoginRequest $loginRequest)
    {
        $loginRequest->authenticate();
        $loginRequest->session()->regenerate();
        FlashMessage::flash('success', 'Login successful.');
        return redirect()->route('user_dashboard');
    }

    public function registerPage()
    {
        return view('pages.user.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Optionally, log the user in after registration
        Auth::login($user);

        // Redirect to a specific page after successful registration
        FlashMessage::flash('success', 'Registration successful.');
        return redirect()->route('user_dashboard');
    }

    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to avoid security issues
        $request->session()->regenerateToken();
        FlashMessage::flash('success', 'Logout successful.');
        // Redirect to the login or home page after logout
        return redirect()->route('index');
    }

    public function userDashboard()
    {
        return view('layouts.user.backend.pages.user-dashboard');
    }

}
