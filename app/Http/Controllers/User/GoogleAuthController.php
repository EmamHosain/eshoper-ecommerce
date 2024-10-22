<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            // Check if a user exists with the same google_id
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // If no user with google_id, check if the email already exists
                $user = User::where('email', $google_user->getEmail())->first();

                if (!$user) {
                    // If no user with the same email, create a new user
                    $new_user = User::create([
                        'first_name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                    ]);

                    Auth::login($new_user);
                } else {
                    // If a user with the same email exists but without google_id, update the google_id
                    $user->update([
                        'google_id' => $google_user->getId(),
                    ]);
                    Auth::login($user);
                }
            } else {
                // If user with google_id exists, log them in
                Auth::login($user);
            }

            return redirect()->route('user_dashboard');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }



}
