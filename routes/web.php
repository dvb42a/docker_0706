<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Beauty\BeautybannerSettingController;
use App\Http\Controllers\Beauty\BeautypageSettingController;
use App\Http\Controllers\Beauty\BeautyMainController;
use App\Http\Controllers\Beauty\BeautyContentManageController;
use App\Http\Controllers\Beauty\BeautyContentCntController;
use App\Http\Controllers\Beauty\BeautyCategoryController;
use App\Http\Controllers\Beauty\BeautyCategory_gpController;
use App\Http\Controllers\Beauty\BeautyChapterController;
use App\Http\Controllers\Beauty\BeautyKeywordController;
use App\Http\Controllers\Beauty\BeautyMediaCategoryController;
use App\Http\Controllers\Beauty\BeautyMediaController;
use App\Http\Controllers\Beauty\BeautyMediaFileController;
use App\Http\Controllers\Beauty\BeautySectionController;
use App\Http\Controllers\Beauty\TestController;
use App\Http\Controllers\Beauty\TestsController;
use App\Http\Controllers\Center\CenterIndexController;
use App\Http\Controllers\Center\CenterAdminsController;
use App\Http\Controllers\Center\CenterRolesController;
use App\Http\Controllers\Account\verifyController;
use App\Http\Controllers\Account\resetPasswordController;
use App\Http\Controllers\Account\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/tailwind', function(){
    return view('tailwindGuide');
});
Route::get('apipad/{id}',function(){return view('Api_test');});
Route::get('api_data',function(){return view('Api_normalCreate');});
Route::get('api_ac',function(){return view('Api_AccountCreate');});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/root/login', [LoginController::class,'showAdminLoginForm'])->name('admin.login');
Route::post('/root/login', [LoginController::class, 'adminLogin']);
Route::get('/forgetpassword', [resetPasswordController::class, 'showForgetpassword'])->name('admin.forgetpassword.get');
Route::post('/forgetpasword', [resetPasswordController::class, 'submitForgetpassword'])->name('admin.forgetpassword.post');

Route::get('/resetpassword/{token}', [resetPasswordController::class, 'showResetpassword'])->name('admin.showresetpassword.get');
Route::post('/resetpassword', [resetPasswordController::class,'submitResetpassword'])->name('admin.submitresetpassword');

Route::get('/verifyEmail/{token}',[verifyController::class,'checkedVerifyEmail'])->name('account.checkedEmail');
Route::get('/verifychecked',[verifyController::class,'verifychecked'])->name('account.verifychecked');

//platform of admin middleware {auth.admin | IPAddresses | VerifyAdmin }
//auth.admin : using for guard while user login checking
//IPAddresses : using for checking the CRSF and token is it got hacked
//VerifyAdmin: using for checking user is it already reset password and verify input email
Route::middleware(['auth.admin','IPAddresses'])->group(function () {
    Route::get('/logout',[LoginController::class,'logout'])->name('admin.logout');
    Route::post('/verifyaccount',[verifyController::class,'submitVerifyAccount'])->name('account.verifysubmit');
    Route::post('/verifyEmail',[verifyController::class,'submuitVerifyEmail'])->name('account.verifyEmailSubmit');

    Route::middleware(['VerifyAdmin','VerifyEmail'])->group(function () {
        Route::prefix('root')->group( function() {

            Route::get('/verifyaccount',[verifyController::class,'verifyaccount'])->name('account.verify');
            Route::get('/verifyEmail',[verifyController::class,'verifyEmail'])->name('account.verifyEmail');
            Route::get('/password',[AccountController::class,'newpassword'])->name('account.renewpassword');
            Route::post('/password',[AccountController::class,'newpasswordsubmit'])->name('account.renewpassword.submit');
            Route::get('/email',[AccountController::class,'newemail'])->name('account.newemail');
            Route::post('/email',[AccountController::class,'newemailsubmit'])->name('acocunt.newemail.submit');
            Route::get('/',[AdminHomeController::class,'index'])->name('admin.main');

            Route::get('/loginhistory',[AccountController::class,'loginhistory'])->name('account.loginhistory');

            //platform:美容
            Route::middleware(['role:admin_s|admin_a|admin_b_beauty|admin_c_beauty_contentEditor,admin'])->group(function () {
                Route::prefix('beauty')->group( function() {
                    Route::get('/',[BeautyMainController::class,'index'])->name('admin.beauty.main');
                    //Route::get('/allsetting', [HomeController::class, 'adminHome'])->name('admin.home');
                    //網頁設定
                    Route::resource('/bannersetting', BeautybannerSettingController::class);
                    Route::get('/pagesetting', [BeautypageSettingController::class, 'index'])->name('admin.beauty.pagesetting');

                    // 關鍵字類別
                    Route::resource('/category', BeautyCategoryController::class );
                    //關鍵字
                    Route::resource('/keyword', BeautyKeywordController::class );
                    //媒體類別
                    Route::post('/mediaCategory/mutiDelete', [BeautyMediaCategoryController::class,'mutiDelete'])->name('mediaCategory.mutiDelete');
                    Route::resource('/mediaCategory', BeautyMediaCategoryController::class );
                    //媒體新增
                    Route::post('/mediaDelete',[BeautyMediaController::class,'mediaDelete'])->name('media.delete');
                    Route::post('/mediaState',[BeautyMediaController::class,'stateUpdate'])->name('media.stateUpdate');
                    Route::resource('/media', BeautyMediaController::class);
                    //媒體資料夾
                    Route::get('/mediaFileTrash',[BeautyMediaFileController::class,'mediaFileTrash'])->name('mediaFile.mediaFileTrash');
                    Route::resource('/mediaFile',BeautyMediaFileController::class);

                    //文章
                    Route::get('/content/preview/{id}',[BeautyContentManageController::class,'preview'])->name('content.preview');
                    Route::post('/content/mutisetting',[BeautyContentManageController::class,'mutisetting'])->name('content.mutisetting');
                    Route::get('/content/Media',[BeautyContentManageController::class,'contentMedia'])->name('content.media');
                    Route::get('/content/all',[BeautyContentManageController::class,'contentindexAll'])->name('content.indexAll');
                    Route::get('/content/Ckeditor/{id}',[BeautyContentManageController::class,'contentCkeditor'])->name('content.ckeditor');
                    Route::resource('/content', BeautyContentManageController::class );
                    Route::resource('/contentcnt', BeautyContentCntController::class);
                    //章節
                    Route::post('/chapter_hashtagCreate',[BeautyChapterController::class,'hashtagCreate'])->name('chapter.hashtagCreate');
                    Route::resource('/chapter',BeautyChapterController::class);
                    Route::get('/section/trash',[BeautySectionController::class,'softdeleteIndex'])->name('section.softdeleteIndex');
                    Route::resource('/section',BeautySectionController::class);

                    //test
                    Route::get('/test_imageUpload',[TestController::class ,'imageUpload'])->name('test.imageUpload');
                    Route::get('/test_chaptertab',[TestController::class,'test_chaptertab'])->name('test.chaptertab');
                    Route::get('/test_iframe',[TestController::class,'iframe'])->name('test.iframe');
                    Route::get('/test_ckeditor',[TestController::class,'ckeditor'])->name('test.ckeditor');
                    Route::resource('/tests',TestsController::class);
                    Route::resource('/test',TestController::class);
                });
            });

            //platform
            Route::prefix('ultraAdmin')->group( function() {
            });


            //platform:全域
            Route::middleware(['role:admin_s|admin_a|,admin'])->group(function () {
                Route::prefix('center')->group( function() {
                    Route::get('/', [CenterIndexController::class, 'index'])->name('admin.center.main');
                    Route::resource('/roles',CenterRolesController::class);
                    Route::resource('/admins',CenterAdminsController::class);
                });
            });

        });
    });
});

