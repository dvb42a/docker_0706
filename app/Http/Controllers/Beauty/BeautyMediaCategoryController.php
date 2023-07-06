<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Beauty\MediaCategory;
use App\Models\Beauty\Media;
use App\Http\Requests\Beauty\mediaCategoryRequest;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Beauty\BeautyMediaController;
use Illuminate\Support\Facades\Storage;


class BeautyMediaCategoryController extends Controller
{
    public function file()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$imgcategorys=MediaCategory::search($request->search)->paginate(10);

        return view('admin.beauty.mediaCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ziped_rates=(new BeautyMediaController) ->ziped_rate();

        return view('admin.beauty.mediaCategory.create',compact('ziped_rates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(mediaCategoryRequest $request)
    {
        //dd($request)->array();
        //設定父子層的資料夾名稱及基礎變數
        $fatherlocation='media/';
        $fix='/small';
        $resize_pesentage=0;

        //-----------------------判斷是否有選擇類型
        if($request->type ==NULL)
        {
            return redirect()->back()->withErrors('請選擇媒體類型')->withInput($request->intput());
        }
        else
        {
            switch($request->type){
                case "photo":
                    $typelocation="_image";
                    $type=1;
                    break;
                case "video":
                    $typelocation="_video";
                    $type=2;
                    break;
            }
        }


        //-----------------------路徑reposition
        $position =$request->position;
        switch($request->situation){
            case 1;
                $kmc_position= "content_".$position;
                break;
            case 2;
                $kmc_position= "course_".$position;
                break;
            case 3;
                $kmc_position= "teacher_".$position;
                break;
            case 4;
                $kmc_position= "banner_".$position;
                break;
            case 5;
                $kmc_position= "advertise_".$position;
                break;
            case 6;
                $kmc_position=$position;
                break;
        }

        //-----------------------整合所有input及父子層影響location之處理
        $location=$fatherlocation.''.$kmc_position.''.$typelocation;
        //dd($location);
        $fixlocation=$fatherlocation.''.$kmc_position.''.$typelocation.''.$fix;
        $kmc_position=$kmc_position.''.$typelocation;

        //驗證已reposition之路徑是否已被使用
        $request->request->add(['kmc_position'=> $kmc_position]);
        $request->validate([
            'kmc_position'=>['unique:k_media_category']
        ]);

        //將表單之是否設定為縮圖轉成var
        $resize_setting=$request->smallimg_setting;

        //-----------------------判斷是否只有輸入單一尺寸
        if(isset($request->img_width) or isset($request->img_height))
        {
            if($request->img_width !==NULL)
            {
            if($request->img_height ==NULL)
            {
                return redirect()->back()->withErrors('請輸入高度')->withinput($request->input());
            }
            }
            else
            {
                return redirect()->back()->withErrors('請輸入寬度')->withinput($request->input());
            }
        }
        //

        //-----------------------判斷是否為縮圖
        if($request->resize=='on')
        {
            //判斷縮圖之比例為何
            $resize='1';
            if ($request->smallimg_setting==0){
                return redirect()->back()->withErrors('請選擇比例')->withInput($request->input());
            }
        }
        else
        {
            $resize='0';
        }

        //-----------------------開始將資料存入資料庫並新增資料夾
        DB::transaction(function() use($request,$location,$position,$fixlocation,$resize,$type,)  {

            //嘗試利用input 輸入之名稱新建一個資料夾
            $path = public_path($location);
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

            //將輸入的值存進資料庫當中
            $category= new MediaCategory ;
            $category->kmc_name=$request->kmc_name;
            $category->kmc_position=$request->kmc_position;
            $category->kmc_width=$request->img_width;
            $category->kmc_height=$request->img_height;
            $category->kmc_file_limited=$request->filelimited;
            $category->kmc_file_type=$type;

            if($resize==1)
            {
                //嘗試於資料夾當中建立子資料夾(small)
                $fix_path = public_path($fixlocation);
                File::isDirectory($fix_path) or File::makeDirectory($fix_path, 0777, true, true);

                //儲存重新調整之縮圖尺寸
                $category->kmc_resize=$request->smallimg_setting;
            }
            else
            {
                $category->kmc_resize=0;
            }

            $category->save();
            session()->flash('message');
        });
        return redirect()->route('mediaCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(mediaCategoryRequest $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mutiDelete(Request $request)
    {
        //$success=0;
        $fail=0;
        for($i=0; $i<count($request->mediacategory); $i++)
        {
            $mediaCategory=MediaCategory::where('kmc_id',$request->mediacategory[$i])->first();
            $mediaCountDeleted=$mediaCategory->MediaCheckDeleteHasMedia->count();
            $mediaCountInFile=$mediaCategory->Media->count();
            if($mediaCountInFile==0 and $mediaCountDeleted==0)
            {
                DB::transaction(function() use($mediaCategory)
                {
                    $location='media/'.''.$mediaCategory->kmc_position;
                    //dd($location);
                    $mediaCategory->delete();
                    File::deleteDirectory($location);
                });
                //$success=$success+1;
            }
            else
            {
                $fail=1;
            }
        }
        if($fail == 0)
        {
            session()->flash('message_delete');
            return redirect()->back();
        }
        else
        {
            if($mediaCountInFile != 0)
            {
                return redirect()->back()->withErrors($mediaCategory->kmc_name.'已擁有媒體，無法刪除。');
            }
            else
            {
                return redirect()->back()->withErrors($mediaCategory->kmc_name.'存在媒體於回收桶當中，無法刪除。');
            }

        }


    }
}
