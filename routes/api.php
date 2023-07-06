<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\tagsController;
use App\Http\Controllers\api\tagsCategoryController;
use App\Http\Controllers\api\chapterController;
use App\Http\Controllers\api\mediaCategoryController;
use App\Http\Controllers\api\mediaController;
use App\Http\Controllers\api\sectionController;
use App\Http\Controllers\api\contentTagController;
use App\Http\Controllers\api\contentController;
use App\Http\Controllers\api\testController;
use App\Http\Controllers\api\Mirror\normalinspectionController;
use App\Http\Controllers\api\Mirror\singledetectionController;
use App\Http\Controllers\api\Mirror\userdataController;
use App\Http\Controllers\api\frontend\pageContentController;
use App\Http\Controllers\api\frontend\bannerController;
use App\Http\Controllers\api\Mirror\algorithmController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\api\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::get('get-user',[AuthController::class,'userInfo']);
    Route::post('logout',[AuthController::class,'logout']);
});

Route::apiResource('category', CategoryController::class);
Route::apiResource('tags',tagsController::class);
Route::apiResource('tagsCategory', tagsCategoryController::class);
Route::apiResource('chapter',chapterController::class);
Route::get('mediaCategoryDelete',[mediaCategoryController::class,'delete']);
Route::apiResource('mediaCategory',mediaCategoryController::class);
Route::apiResource('sections', sectionController::class);
Route::get('sectionDelete', [sectionController::class,'delete']);
Route::apiResource('contentHashtag',contentTagController::class);
Route::apiResource('content',contentController::class);
Route::apiResource('media',mediaController::class);
Route::apiResource('normalinspection',normalinspectionController::class);
Route::apiResource('detection',singledetectionController::class);
Route::get('detectionShow',[singledetectionController::class,'detectionShow']);
Route::apiResource('userdata',userdataController::class);
Route::get('banner',[bannerController::class,'bannerShow']);

Route::get('pageContent',[pageContentController::class,'pageContent']);
Route::get('pageContentChapter/{id}',[pageContentController::class,'pageContentChapter']);
Route::get('pageContentKeyword/{id}',[pageContentController::class,'pageContentKeyword']);
Route::get('pageContentArticle/{id}',[pageContentController::class,'pageContentArticle']);

Route::apiResource('algorithm',algorithmController::class);
Route::apiResource('test', testController::class);
