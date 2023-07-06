<?php

namespace App\Http\Controllers\Center;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\adminRequest;
use Illuminate\Support\Facades\Hash;



class CenterAdminsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.center.admin.index');
    }

    public function create()
    {
/*         $permissions=Permission::all();
        $permissions_beauty=$permissions->where('platform','beauty')->sortBy('rank');
        $permissions_center=$permissions->where('platform','center')->sortBy('rank');
        $permissions_production=$permissions->where('platform','production')->sortBy('rank');
        $permissions_production_mirror=$permissions->where('platform','production_mirror')->sortBy('rank'); */
        $platform=Role::where('name','like','%admin_b%')->get();
        $beauty_roles=Role::where('name','like','%beauty_%')->get();
        $mirror_roles=Role::where('name','like','%mirror_%')->get();
        //dd($mirror_roles);
        return view('admin.center.admin.create',compact('platform','beauty_roles','mirror_roles'));
    }

    public function store(adminRequest $request)
    {
        //dd($request);

        $admin=new Admin;
        $admin->name=$request->name;
        $admin->account=$request->account;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->status=0;
        $admin->save();



        switch($request->role)
        {
            case('admin_a'):
                    $admin->assignRole($request->role);
                break;
            case('admin_b'):
                if($request->platform == NULL)
                {
                    return redirect()->back()->withErrors('請選擇職位')->withInput();
                }
                else
                {
                    $admin->assignRole($request->platform);
                }
                break;
            case('admin_c'):
                if($request->lvc ==NULL)
                {
                    return redirect()->back()->withErrors('請選擇職位')->withInput();
                }
                else
                {
                    $admin->assignRole($request->lvc);
                }
                break;
        }

        session()->flash('message');
        return redirect()->route('admins.index');

    }

    public function show($id)
    {

        return view('admin.center.admin.show');
    }

}
