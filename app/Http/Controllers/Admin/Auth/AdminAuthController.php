<?php

namespace App\Http\Controllers\Admin\Auth;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('pages.admin.auth.login');
    }
    public function loginSubmit(AdminLoginRequest $adminLoginRequest)
    {
        $adminLoginRequest->authenticate();
        $adminLoginRequest->session()->regenerate();
        // FlashMessage::flash('success', 'Login successful.');
        // return redirect()->route('dashboard');
        return redirect()->route('admin.admin_dasboard');
    }

    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::guard('admin')->logout();
        // Invalidate the session
        $request->session()->invalidate();
        // Regenerate the CSRF token to avoid security issues
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');

    }
    public function forgotPasswordPage()
    {
        return view('pages.admin.auth.forgot-password');
    }
    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            $token = hash('sha256', time());

            $is_admin = Admin::where('email', $admin->email)->first();
            if (!$is_admin) {
                Admin::insert([
                    'email' => $admin->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                Admin::where('email', $is_admin->email)->update([
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }

            $reset_link = url(route('admin.reset_password_page', $token) . '?email=' . $admin->email);
            Mail::to($admin->email)->send(new AdminResetPasswordMail($admin->name, $reset_link));


            return redirect()->back()->with(['status' => 'Reset password link sent to your email.']);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email',
        ]);
    }


    public function resetPasswordPage($token)
    {
        return view('pages.admin.auth.reset-password', [
            'token' => $token
        ]);
    }




    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'token' => 'required|exists:admins,token',
            'password' => 'required|min:8|confirmed',

        ]);

        // Find the admin using the provided email and token
        $admin = Admin::where('email', $request->email)
            ->first();

        $is_admin_token = Admin::where('email', $request->email)
            ->where('token', $request->input('token'))->first();

        if (!$admin || !$is_admin_token) {
            return redirect()->back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Update the password and invalidate the token
        $admin->update([
            'password' => Hash::make($request->password),
            'token' => null
        ]);

        // Redirect with a success message
        return redirect()->route('login')->with(['status' => 'Your password has been successfully reset.']);
    }

}
