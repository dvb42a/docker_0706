<?php

namespace App\Http\Controllers\Center;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CenterRolesController extends Controller
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
        return view('admin.center.role.index');
    }

    public function create()
    {
        return view('admin.center.role.create');
    }

    public function edit()
    {
        return view('admin.center.role.edit');
    }
}
