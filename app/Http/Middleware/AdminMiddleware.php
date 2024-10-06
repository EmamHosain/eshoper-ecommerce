<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            FlashMessage::flash('error','You do not permission to access this page.');
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
