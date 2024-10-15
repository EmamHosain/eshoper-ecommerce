<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->route('search_by_product')->with('warning', 'Please Add To Cart First!');
        }

        if (!Auth::check()) {
            session()->put('url.intended', $request->url());
            return redirect()->route('login')->with('warning', 'Login First!');
        }

        return $next($request);

    }
}
