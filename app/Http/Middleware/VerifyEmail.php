<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use App\Models\VerifyEmail as CheckEmail;


class VerifyEmail
{
    use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public $cooldown_at=null;
    public $count_email=0;

    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->user()->email_verified_at==NULL)
        {
            $emails=CheckEmail::where('email', Auth::guard('admin')->user()->email)->orderBy('created_at', 'desc')->get();
            $created_data=$emails->first();
            if($created_data != null)
            {
                $this->cooldown_at = $created_data->cooldown_at;
            }
            $count_email=$emails->count();
            return new response(view('admin.account.verifyEmail')->with(['cooldown_at'=>$this->cooldown_at,]));
        }
        else
        {
            return $next($request);
        }


    }
}
