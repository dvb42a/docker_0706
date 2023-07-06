<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class IPAddresses
{
    use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Hash::check(gethostbyaddr($_SERVER['REMOTE_ADDR']) ,Auth::guard('admin')->user()->login_log))
        {
            return $next($request);
        }
        else
        {
        /*     $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return view('login'); */
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            if ($response = $this->loggedOut($request)) {
                return $response;
            }

            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('/root/login');
        }

    }
}
