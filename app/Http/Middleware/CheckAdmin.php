<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user terautentikasi dan memiliki role 'admin'
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'seller')) {
            return $next($request);
        }

        // Jika bukan admin, arahkan kembali ke halaman home atau halaman lain
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
