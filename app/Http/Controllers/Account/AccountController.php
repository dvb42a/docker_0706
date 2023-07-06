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
use Illuminate\Validation\Rule;


class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function loginhistory()
    {
        $logs=LogAdmin::where('id',Auth::guard('admin')->user()->id)->orderBy('login_at','desc')->take(14)->get();
        //dd($logs);

        return view('admin.account.loginHistory',compact('logs'));
    }

    public function newpassword()
    {
        return view('admin.account.resetpassword');
    }

    public function newpasswordsubmit(Request $request)
    {
        $request->validate([
            'current_password'=>'required|string|',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);
        $checkpassword=Admin::find(Auth::guard('admin')->user()->id);
        if(Hash::check($request->current_password,$checkpassword->password))
        {
            $checkpassword->password=Hash::make($request->new_password);
            $checkpassword->save();

            session()->flash('message_update');
            return redirect()->route('admin.main');
        }
        else
        {
            return  back()->withErrors(['current_password'=>'輸入之密碼不相符。']);
        }
    }

    public function newemail()
    {
        return view('admin.account.email');
    }

    public function newemailsubmit(Request $request)
    {
        $request->validate([
            'current_password'=>'required|string|',
            'email'=>['required','email',Rule::unique('admins')->ignore(Auth::guard('admin')->user()->id, 'id')],
        ]);

        $checkpassword=Admin::find(Auth::guard('admin')->user()->id);
        if(Hash::check($request->current_password,$checkpassword->password))
        {
            $checkpassword->email=$request->email;
            $checkpassword->email_verified_at=NULL;
            $checkpassword->save();

            session()->flash('message_update');
            return redirect()->route('admin.main');
        }
        else
        {
            return  back()->withErrors(['current_password'=>'輸入之密碼不相符。']);
        }
    }
}
