<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;

class roleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            ['name'=>'admin_s' , 'c_name'=>'系統開發資料庫工程師','guard_name'=>'admin'],
            ['name'=>'admin_a' , 'c_name'=>'後台全域管理員','guard_name'=>'admin'],
            ['name'=>'admin_b_beauty' , 'c_name'=>'美容百科主管','guard_name'=>'admin'],
            ['name'=>'admin_b_mirror' , 'c_name'=>'美容鏡管理平台主管','guard_name'=>'admin'],
            ['name'=>'admin_c_beauty_contentEditor' , 'c_name'=>'美容百科小編','guard_name'=>'admin'],
            ['name'=>'admin_c_beauty_courseEditor' , 'c_name'=>'美容百科課程管理者','guard_name'=>'admin'],
            ['name'=>'admin_c_beauty_ebusiness' , 'c_name'=>'美容百科行銷人員','guard_name'=>'admin'],
            ['name'=>'admin_c_mirror_enginer' , 'c_name'=>'美容鏡工程師','guard_name'=>'admin'],
        ];

        foreach($roles as $role)
        {
            Role::create($role);
        }

    }
}
