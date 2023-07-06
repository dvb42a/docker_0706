<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;


class VerifyAdmin
{
    use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->user()->email_verified_at==NULL and Auth::guard('admin')->user()->password_verified_at ==NULL)
        {
            return new response(view('admin.account.verifyaccount'));
        }
        else
        {
            return $next($request);
        }


    }
}
