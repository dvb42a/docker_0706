<?php

namespace App\Http\Controllers\Center;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CenterIndexController extends Controller
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
    public function index()
    {
/*         $admin=Auth::guard('admin')->user();
        if($admin->hasAnyRole(['admin_s','admin_a']))
        {
           dd('123');
        }
        else
        {
            dd('456');
        } */
        return view('admin.center.main');
    }
}
