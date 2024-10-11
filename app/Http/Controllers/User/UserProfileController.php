<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function userProfilePage()
    {
        return view('layouts.user.pages.user-profile');
    }

    public function changePasswordPage()
    {
        return view('layouts.user.pages.change-password');
    }
}
