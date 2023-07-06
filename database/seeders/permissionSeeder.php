<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
/*       $admin=Admin::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      ]);
      $admin_role = Role::create(['name' => 'admin' , 'guard_name'=>'admin']);
      $admin->assignRole($admin_role); */

    $permissions=[


        //beauty_section
        //Rank B
        ['name'=>'beauty_admin','guard_name'=>'admin','c_name'=>'管理員帳號頁面','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_member','guard_name'=>'admin','c_name'=>'會員帳號頁面','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_content_delete','guard_name'=>'admin','c_name'=>'主題內容文章永久刪除','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_content_submit','guard_name'=>'admin','c_name'=>'主題內容文章發布確認','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_transfer','guard_name'=>'admin','c_name'=>'交易管理頁面','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_mediacategory_create','guard_name'=>'admin','c_name'=>'媒體資料夾新增','rank'=>'B','platform'=>'beauty'],
        ['name'=>'beauty_media_delete','guard_name'=>'admin','c_name'=>'媒體永久刪除','rank'=>'B','platform'=>'beauty'],
        //Rank C
        ['name'=>'beauty_website','guard_name'=>'admin','c_name'=>'網頁設定頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_content','guard_name'=>'admin','c_name'=>'主題內容管理頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_course','guard_name'=>'admin','c_name'=>'課程管理頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_advert','guard_name'=>'admin','c_name'=>'廣告管理頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_comment','guard_name'=>'admin','c_name'=>'留言管理頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_media','guard_name'=>'admin','c_name'=>'媒體管理頁面','rank'=>'C','platform'=>'beauty'],
        ['name'=>'beauty_keyword','guard_name'=>'admin','c_name'=>'關鍵字管理頁面','rank'=>'C','platform'=>'beauty'],


        //center_section
        //Rank A
        ['name'=>'center_member','guard_name'=>'admin','c_name'=>'全域會員管理頁面','rank'=>'A','platform'=>'center'],
        ['name'=>'center_admin','guard_name'=>'admin','c_name'=>'後台全域管理員管理頁面','rank'=>'A','platform'=>'center'],
        ['name'=>'center_admin_role_crud','guard_name'=>'admin','c_name'=>'後台全域權限與身份管理頁面','rank'=>'A','platform'=>'center'],
        ['name'=>'center_transfer','guard_name'=>'admin','c_name'=>'全域權交易管理頁面','rank'=>'A','platform'=>'center'],
        ['name'=>'center_pinsetting','guard_name'=>'admin','c_name'=>'PIN碼管理頁面','rank'=>'A','platform'=>'center'],



        //production_section
        ['name'=>'production_QA','guard_name'=>'admin','c_name'=>'產品QA管理頁面','rank'=>'C','platform'=>'production'],
        ['name'=>'production_history','guard_name'=>'admin','c_name'=>'產品維修記錄頁面','rank'=>'C','platform'=>'production'],

        //mirror_section
        ['name'=>'production_mirror_setting','guard_name'=>'admin','c_name'=>'美容鏡參數設定頁面','rank'=>'C','platform'=>'production_mirror'],
        ['name'=>'production_mirror_info','guard_name'=>'admin','c_name'=>'美容鏡資訊頁面','rank'=>'C','platform'=>'production_mirror'],



    ];

    foreach($permissions as $permission)
    {
        Permission::create($permission);
    }

    }
}


