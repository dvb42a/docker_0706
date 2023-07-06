<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Log\LogAdmin;
use Auth;
use App\Http\Controllers\Controller;
use Mail;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Rule;

class resetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showForgetpassword()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetpassword(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required|email|exists:admins',
        ]);

        $token = Str::random(64);

        $checkingTokens=DB::table('password_resets')->where('email',$request->email)->delete();

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(15)
          ]);

        Mail::send('email.resetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Kings後台管理員帳號重設密碼通知');
        });

        return back()->with('message', '重設密碼的信件已送出。請於15分鐘內打開信件之連結重設密碼');
    }

    public function showResetpassword($token)
    {

        $updatePassword=DB::table('password_resets')
        ->where([
        'token' => $token
        ])
        ->first();
        if(!$updatePassword){
            return view('error')->with('error','連結已失效');
        }
        if(now() >=$updatePassword->expired_at )
        {
            return view('error')->with('error','已超過使用期限');
        }
        return view('auth.resetPassword',['token'=>$token]);
    }

    public function submitResetpassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $updatePassword=DB::table('password_resets')
        ->where([
        'token' => $request->token
        ])
        ->first();

        /* if(!$updatePassword){
            return back()->with('error','無效之連結。');
                } */

        if($request->new_password == "61261370")
        {
            return back()->with('error','不能使用預設密碼作為密碼。');
        }


        $user = Admin::where('email', $updatePassword->email)
        ->update(['password' => Hash::make($request->new_password)]);

        DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

        return redirect()->route('admin.login')->with('message', '密碼已重設。');
    }
}
