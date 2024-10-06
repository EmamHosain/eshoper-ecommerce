<?php

namespace App\Http\Middleware;

use App\Helper\FlashMessage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::guard('admin')->check()) {
            FlashMessage::flash('error','You do not access this page before you logout.');
            return redirect()->back();
        }
        return $next($request);
    }
}
