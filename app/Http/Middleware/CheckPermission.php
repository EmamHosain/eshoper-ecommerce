<?php

namespace App\Http\Middleware;

use App\Helper\FlashMessage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
       
        $user = Auth::guard('admin')->user();
        if ($user && $user->can($permission)) {
            return $next($request);
        }
        FlashMessage::flash('error','You do not have permission to access this page.');
        return redirect()->route('admin.admin_dasboard');
    }
}
