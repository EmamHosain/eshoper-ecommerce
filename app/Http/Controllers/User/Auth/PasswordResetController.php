<?php
namespace App\Http\Controllers\User\Auth;

use App\Helper\FlashMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    // Show form to request password reset link
    public function showLinkRequestForm()
    {
        return view('pages.user.auth.forgot-password-send-email');
    }

    // Send the password reset link to the provided email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Email has been sent successfully.'])
            : back()->withErrors(['email' => __($status)]);
    }

    // Show form to reset password using the token received by email
    public function showResetForm($token)
    {
        return view('pages.user.auth.reset-password', ['token' => $token]);  // Create the view file for password reset form
    }

    // Handle resetting the password
    public function reset(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        // Reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password updated successfully.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
