<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $setting = Setting::first();
        return view('layouts.admin.about-us.about-us',[
            'setting'=> $setting
        ]);
    }

    public function AboutUpdateOrCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_us' => 'required'
        ], [
            'about_us.required' => 'About us content is required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // Use updateOrCreate to simplify logic
        Setting::updateOrCreate(
            ['id' => 1], // Assuming you only have one settings record
            ['about_us' => $request->input('about_us')]
        );

        FlashMessage::flash('success', 'Content updated successfully.');
        return redirect()->back();
    }

}
