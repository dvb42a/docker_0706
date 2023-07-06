<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Log\LogAdmin;
use Auth;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logs=LogAdmin::where('id',Auth::guard('admin')->user()->id)->orderBy('login_at','desc')->take(5)->get();
        //dd($logs);
        return view('admin.home');
    }
}
