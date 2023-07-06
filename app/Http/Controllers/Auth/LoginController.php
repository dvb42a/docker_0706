<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Log\LogAdmin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');

    }

    public function showAdminLoginForm()
    {
        return view('auth.login_admin');
    }

    public function adminLogin(Request $request)
    {
        $login_ip=Hash::make(gethostbyaddr($_SERVER['REMOTE_ADDR']));
        $this->validate($request, [
            'account'=> 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['account' => $request->account, 'password' => $request->password ,'status'=> 0], $request->get('remember'))) {

            Auth::logoutOtherDevices($request['password']);
            $user=Admin::find(Auth::guard('admin')->user()->id);
            $user->login_log=$login_ip;
            $user->trytimes=0;
            $user->save();
            $status=1;
            $this->droplog($user,$status);


            switch ($request->target_location)
                {
                    case('PlatformAdmin'):
                    {
                        if(Auth::guard('admin')->user()->hasRole(['admin_s','admin_a']))
                        {
                            return redirect()->route('admin.center.main');
                        }
                        else
                        {
                            $this->guard()->logout();
                            $request->session()->invalidate();

                            return redirect()->back()->withErrors('此帳號並無該平台使用權限')->withInput();
                        }
                        //break;
                    }
                    case('Beauty'):
                    {
                        return redirect()->route('admin.beauty.main');
                        //break;
                    }
                    case('Sport'):
                    {

                    }
                }
        }
        else
        {

            $user=Admin::where('account',$request->account)->first();
            $status=0;
            if($user != Null)
            {
                if($user->trytimes >=4)
                {
                    $user->status=1;
                    $user->save();
                    $message='密碼輸入錯誤次數超過上限，帳號已被凍結。';
                }
                else
                {
                    $this->droplog($user,$status);
                    $user->trytimes=$user->trytimes+1;
                    $user->save();
                    $user=Admin::where('account',$request->account)->first();
                    $changes=5-$user->trytimes;
                    $message='帳號或密碼輸入錯誤，輸入錯誤次數剩餘'.$changes.'次。';
                }

            }
            else
            {
                $message='帳號或密碼輸入錯誤。';
            }
            //$user=Admin::where('account',$request->account)->first();

            return redirect()->back()
                ->withInput()
                ->withErrors($message);
        }
        return back()->withInput($request->only('account', 'remember'));
    }



    public function logout( Request $request )
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function droplog($user,$status)
    {
        $log=new LogAdmin;
        $log->id=$user->id;
        $log->login_at=date('Y-m-d H:i:s');
        $log->status=$status;
        $log->save();
    }

}
