<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function callback()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $facebook_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'first_name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId(),
                ]);

                Auth::login($new_user);

                return redirect()->route('user_dashboard');
            } else {
                Auth::login($user);
                return redirect()->route('user_dashboard');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
