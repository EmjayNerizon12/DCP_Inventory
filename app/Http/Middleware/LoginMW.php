<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        // Redirect school user
        if (Auth::guard('school')->check()) {
            return redirect()->route('school.dashboard'); // define this named route
        }

        return $next($request);
    }
}
