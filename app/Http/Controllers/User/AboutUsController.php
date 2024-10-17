<?php

namespace App\Http\Controllers\User;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function aboutUs()
    {

        $setting = Setting::first();
        return view('pages.frontend.about-us',[
            'setting'=> $setting
        ]);
    }
}
