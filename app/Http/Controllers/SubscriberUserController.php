<?php
namespace App\Http\Controllers;

use App\Models\SubscriberUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberUserController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriber_users,email', // Ensure email is unique
            'name' => 'nullable|max:50'
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        // Create a new subscriber
        SubscriberUser::create($request->only('email', 'name')); // Avoid mass assignment by using only()

        return response()->json([
            'success' => 'Email submitted successfully.',
        ]);
    }
}