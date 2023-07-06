<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\VerifyEmail;
use App\Models\Log\LogAdmin;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class verifyController extends Controller
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
    public function verifyaccount()
    {
        return view('admin.account.verifyaccount');
    }


    public function submitVerifyAccount(Request $request)
    {
        $request->validate([
            'email'=>['nullable','email',Rule::unique('admins')->ignore(Auth::guard('admin')->user()->id, 'id')],
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        //驗證密碼是否為預設之密碼
        if($request->password == "61261370")
        {
            return back()->with('error','不能使用預設密碼作為密碼。');
        }

        $admin=Admin::where('name',Auth::guard('admin')->user()->name)->first();
        if($request->email != NULL)
        {
            $admin->email=$request->email;
            $email=$request->email;
        }
        else
        {
            $email=$admin->email;
        }

        $admin->password=Hash::make($request->new_password);
        $admin->password_verified_at=date('Y-m-d H:i:s');
        $admin->save();

        $token=$this->create_emailVerify_token($email);
        $cooldown_at= $token->cooldown_at;
        Mail::send('email.verifyEmail', ['token' => $token->token], function($message) use($request,$email){
            $message->to($email);
            $message->subject('Kings後台管理員電郵信箱驗證通知');
        });

        return redirect()->route('account.verifyEmail')->with(['message'=> '驗證信件已送出，請檢查已輸入之電郵。',
                                                        'cooldown_at'=>$cooldown_at]);
    }

    public function verifyEmail()
    {
        return view('admin.account.verifyEmail');
    }

    public function submuitVerifyEmail(Request $request)
    {
/*         $request->validate([
            'email' => ['required','email',Rule::unique('admins')->ignore(Auth::guard('admin')->user()->id, 'id')],
        ]); */

        $admin=Admin::where('name',Auth::guard('admin')->user()->name)->first();
        $email=$admin->email;
        $checkBeforeVerfiyEmail=VerifyEmail::where('email', $email)->orderBy('created_at','desc')->first();
        if($checkBeforeVerfiyEmail !=NULL)
        {
            if(now() >= $checkBeforeVerfiyEmail->cooldown_at)
            {
                $email=$this->sendEmail($email,$request);
                return back()->with([
                    'message'=>'驗證信件已送出，請檢查已綁定之電郵地址。',
                ]);
            }
            else
            {
                return back()->with([
                    'error'=>'請等待冷卻時間。',
                ]);
            }
        }
        else
        {
            $email=$this->sendEmail($email,$request);
             return back()->with([
            'message'=>'驗證信件已送出，請檢查已綁定之電郵地址。',
            ]);
        }

    }

    public function checkedVerifyEmail(Request $request)
    {
        $verifyEmail=DB::table('email_verify')
        ->where([
        'token' => $request->token
        ])
        ->first();

        if(!$verifyEmail){
        return view('admin.account.verifychecked')->with('error', '無效之重設密碼連結。');
        }

        if(now() >=$verifyEmail->expired_at )
        {
            return view('error')->with('error','已超過使用期限');
        }


        $user=Admin::where('email',$verifyEmail->email)
        ->update(['email_verified_at'=>date('Y-m-d H:i:s')]);

        DB::table('email_verify')->where(['email'=> $verifyEmail->email])->delete();

        return view('admin.account.verifychecked')->with('message','電郵地址已完成驗證。');

    }

    public function verifychecked()
    {
        return view('admin.account.verifychecked');
    }


    public function sendEmail($email,$request)
    {
        $token=$this->create_emailVerify_token($email);

        Mail::send('email.verifyEmail', ['token' => $token->token], function($message) use($request,$email){
            $message->to($email);
            $message->subject('Kings後台管理員電郵信箱驗證');
        });

    }

    public function create_emailVerify_token($email)
    {


        $beforeVerfiyCount=VerifyEmail::where('email', Auth::guard('admin')->user()->email)->get()->count();
        $cooldownTime=1;

        // cool down count table
        // 1  -> 1 mins
        // 2  -> 2 mins
        // 3  -> 5 mins
        // 4  -> 15 mins
        // >=5-> 30 mins

        //switching about add how logn of the cooldown time
        if($beforeVerfiyCount >=1 and $beforeVerfiyCount <=4)
        {
            switch($beforeVerfiyCount)
            {
                case('1'):
                    $cooldownTime=1;
                    break;
                case('2'):
                    $cooldownTime=2;
                    break;
                case('3'):
                    $cooldownTime=5;
                case('4'):
                    $cooldownTime=15;
            }
        }
        elseif($beforeVerfiyCount >=5)
        {
            $cooldownTime=30;
        }


        $token = Str::random(64);

        $create_verify=new VerifyEmail;
        $create_verify->email=$email;
        $create_verify->token=$token;
        $create_verify->created_at=Carbon::now();
        $create_verify->cooldown_at=Carbon::now()->addMinute($cooldownTime);
        $create_verify->expired_at=Carbon::now()->addMinute(15);
        $create_verify->save();
        $created_data= VerifyEmail::where('token', $token)->first();
        return($created_data);
    }
}
