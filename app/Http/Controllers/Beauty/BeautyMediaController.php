<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Beauty\MediaRequest;
use App\Http\Requests\Beauty\MediaUpdateRequest;
use App\Models\Beauty\Category;
use App\Models\Beauty\Categorygp;
use App\Models\Beauty\MediaCategory;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaTag;
use App\Models\Beauty\Tag;
use DB;
use Illuminate\Validation\Rules\File as Filecheck;
use File;
use Illuminate\Validation\Rule;


class BeautyMediaController extends Controller
{
    public function ziped_rate(){
        $ziped_rate=["10","25","50"];
        return($ziped_rate);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        print($id);
        dd($request)->array();
        //return view('admin.beauty.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        //dd($request)->array();
        //讀取數據
        $img_og_name=$request->file->getClientOriginalName();
        //圖片大小
        $img_size=$request->file->getSize();
        //讀取圖片尺寸
        $img_data=getimagesize($request->file);
        //寬
        $width=$img_data[0];
        //高
        $height=$img_data[1];
        //時間 格式:20221102
        $date= Carbon::now()->format('Ymd');
        //request 自訂名稱
        $img_rename=$request->km_cname;
        //抓取圖片之類型
        $type=".".$request->file->extension();
        //存檔時最終取用之名稱
        $img_final_name=$date."_".$img_rename.$type;


        //讀取資料夾內容
        $file=$request->file_id;
        $save_position_data=MediaCategory::find($file);
        //正常圖片之存放路徑設定
        $save_position_address=$save_position_data->kmc_position;
        $save_location= "media/". $save_position_address;
        //縮小圖片之存放路徑設定
        $save_location_ziped=$save_location."/small";
        //圖案大小參考檔:
        $setting_size=$save_position_data->kmc_file_limited;
        $setting_size=$setting_size*1024;
        $setting_width=$save_position_data->kmc_width;
        $setting_height=$save_position_data->kmc_height;

        //dd($setting_width)->array();
        //影片時需重用
        $this->validate($request,[
            'file' =>
                    Filecheck::types(['jpg','png','jepg'])->max($setting_size),
        ]);

        if($setting_width !=NULL and $setting_height!=NULL)
        {
            $this->validate($request,[
                'file' =>
                        Rule::dimensions()->width($setting_width)->height($setting_height),
            ]);
        }

        DB::transaction(function() use($img_rename, $img_final_name, $file, $request , $img_size, $width, $height, $save_location,$save_position_data)  {

            //save data
            $media= new Media;
            $media->km_cname = $img_rename;
            $media->km_name = $img_final_name;
            $media->kmc_id = $file;
            if($request->km_cnt !==NULL)
            {
                $media->km_cnt = $request->km_cnt;
            }
            $media->km_state= 1;
            $media->km_size = $img_size;
            $media->km_mediawidth= $width;
            $media->km_mediaheight= $height;
            $media->created_at = date('Y-m-d H:i:s');
            $media->save();
            $media_id = $media->km_id;

            //save keywords
            $media_keyword=$request->keywords;
            $this->mediaTag($media_keyword, $media_id);


            //save image
            //saving resize image if it selected resize
            if($save_position_data->kmc_resize !=0 )
            {
                $rate=$this->ziped_rate();
                switch($save_position_data->kmc_resize)
                {
                    case 1:
                        $zip_rate = $rate[0]/100;
                        break;
                    case 2:
                        $zip_rate = $rate[1]/100;
                        break;
                    case 3:
                        $zip_rate = $rate[2]/100;
                        break;
                }
                $ziped_width = $width * $zip_rate;
                $ziped_height= $width * $zip_rate;

                $img_ziped = Image::make($request->file->path());
                $img_ziped= $img_ziped->resize($ziped_width,$ziped_height , function ($const) {
                    $const->aspectRatio();})
                    ->save($save_location ."/small/". $img_final_name , 80);
            }

            //saving the og size of the image
            $request->file->move(public_path($save_location), $img_final_name);

            session()->flash('message');
        });
        return redirect()->route('mediaFile.show',$file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting=MediaCategory::find($id);



        return view('admin.beauty.media.create',compact('setting','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media=Media::where('km_id',$id)->with('mediacategory')->first();
        $setting=MediaCategory::find($media->kmc_id);
        $id=$media->kmc_id;
        //dd($media)->array();
        return view('admin.beauty.media.edit',compact('setting','media','id'));
    }

    public function contentBannerDelete($id)
    {
        DB::transaction(function() use($id)  {
            //抓圖片設定檔
            $img=Media::with('MediaCategory')->where('km_id',$id)->first();
            $softdelete_location="media/content_banner_image/".$img->km_name;
            $softdelete_zip_location="media/content_banner_image/small/".$img->km_name;

            Media::destroy($id);
            File::delete($softdelete_location);
            File::delete($softdelete_zip_location);
            MediaTag::where('km_id',$id)->delete();
        });

    }
    public function activeable($id,$state)
    {
        DB::transaction(function() use($id,$state)  {
            //抓圖片設定檔
            $img=Media::with('MediaCategory')->where('km_id',$id)->first();
            //原有圖片絕對路徑
            $img_location="media/". $img->MediaCategory->kmc_position.'/'. $img->km_name;
            //停用資料夾之路徑
            $deactive_location="media/hidden/".$img->km_name;
            //刪除資料夾之路徑
            $softdelete_location="media/trash/".$img->km_name;
            //資料夾之縮圖路徑
            $img_zip_location="media/". $img->MediaCategory->kmc_position.'/small/'. $img->km_name;
            //停用資料夾之縮圖路徑
            $deactive_zip_location="media/hidden/small/".$img->km_name;
            //刪除資料夾之縮圖路徑
            $softdelete_zip_location="media/trash/small/".$img->km_name;


            //dd($state);
            //判斷是顯示/停用 並移動該照片
            switch($state)
            {
                case 0 :
                    if($img->km_state ==1)
                    {
                        try
                        {
                            File::move($img_location, $softdelete_location);
                            if($img->MediaCategory->kmc_resize!=0)
                            {
                                File::move($img_zip_location,$softdelete_zip_location);
                            }
                        }
                        catch(\Exception $e)
                        {
                            return false;
                        }
                    }
                    else
                    {
                        try
                        {
                            File::move($deactive_location, $softdelete_location);
                            if($img->MediaCategory->kmc_resize!=0)
                            {
                                File::move($deactive_zip_location,$softdelete_zip_location);
                            }
                        }
                        catch(\Exception $e)
                        {
                            return false;
                        }
                    }
                    break;
                case 1 :
                    try
                    {
                        File::move($deactive_location,$img_location);
                        if($img->MediaCategory->kmc_resize!=0)
                        {
                            File::move($deactive_zip_location,$img_zip_location);
                        }
                    }
                    catch(\Exception $e)
                    {
                        return false;
                    }
                    break;

                case 2 :
                    try
                    {
                        File::move($img_location,$deactive_location);
                        if($img->MediaCategory->kmc_resize!=0)
                        {
                            File::move($img_zip_location,$deactive_zip_location);
                        }
                    }
                    catch(\Exception $e)
                    {
                        return false;
                        dd('error');
                    }

                    break;
                case 3 :
                    $state=1;
                    try
                    {
                        File::move($softdelete_location,$img_location);
                        if($img->MediaCategory->kmc_resize!=0)
                        {
                            File::move($softdelete_zip_location,$img_zip_location);
                        }
                    }
                    catch(\Expcetion $e)
                    {
                        return false;
                    }

                    break;
                case 4 :
                    Media::destroy($id);
                    File::delete($softdelete_location);
                    File::delete($softdelete_zip_location);
                    MediaTag::where('km_id',$id)->delete();
                    break;
            }
            $img->km_state=$state;
            $img->save();
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MediaUpdateRequest $request, $id)
    {
        //dd($request)->array();
        $media=Media::with('MediaCategory')->where('km_id',$id)->first();
        if($request->file !=null)
        {
             //圖片大小
            $img_size=$request->file->getSize();
            //讀取圖片尺寸
            $img_data=getimagesize($request->file);
            //寬
            $width=$img_data[0];
            //高
            $height=$img_data[1];
            //抓取圖片之類型
            $type=".".$request->file->extension();

            //原先路徑+檔名:
            $old_image_location="media/".$media->MediaCategory->kmc_position.'/'.$media->km_name;
            //原有之路徑:
            $media_location="media/".$media->MediaCategory->kmc_position.'/';
            //原有之-檔案名稱:
            $media_name=$media->km_name;
            //圖案大小參考檔:
            $setting_size=$media->MediaCategory->kmc_file_limited;
            $setting_size=$setting_size*1024;

            $this->validate($request,[
                'file' => Filecheck::types(['jpg','png','jepg'])
                        ->max($setting_size)]);

            //檢查是否有這檔案並刪除
            if(file::exists($old_image_location)){
                file::delete($old_image_location);
            }

            //把新的圖片放進資料夾當中
            if($media->MediaCategory->kmc_resize !=0 )
            {
                $rate=$this->ziped_rate();
                //判斷resize之尺寸及return對應之比例
                switch($media->MediaCategory->kmc_resize)
                {
                    case 1:
                        $zip_rate = $rate[0]/100;
                        break;
                    case 2:
                        $zip_rate = $rate[1]/100;
                        break;
                    case 3:
                        $zip_rate = $rate[2]/100;
                        break;
                }
                //重新計算縮圖的尺寸大小
                $ziped_width = $width * $zip_rate;
                $ziped_height= $width * $zip_rate;
                //圖片儲存路徑
                $save_location=$media->MediaCategory->kmc_position;
                //原有圖片絕對路徑
                $old_image_location_ziped="media/".$media->MediaCategory->kmc_position.'/small/'.$media->km_name;
                //判斷是否有並將舊的圖片刪除
                if(file::exists($old_image_location_ziped)){
                    file::delete($old_image_location_ziped);
                }
                //將新的縮圖存檔到small 資料夾當中
                $img_ziped = Image::make($request->file->path());
                $img_ziped= $img_ziped->resize($ziped_width,$ziped_height , function ($const) {
                    $const->aspectRatio();})
                    ->save("media/".$save_location ."/small/". $media_name , 80);
            }
            //將原始大小的圖片存檔
            $request->file->move(public_path($media_location), $media_name);

            //媒體週邊資訊記錄:
            $media->km_size=$img_size;
            $media->km_mediawidth=$width;
            $media->km_mediaheight=$height;

        };

        //其他有關於圖片的內容
        $media->km_cnt=$request->km_cnt;
        $media->updated_at= date('Y-m-d H:i:s');
        $media->save();

        $media_keywords=MediaTag::where('km_id',$id)->delete();
        $media_keyword=$request->keywords;
        $this->mediaTag($media_keyword, $id);

        //原始圖片之狀態:
        $og_state=$media->km_state;
        //所輸內之圖片狀態:
        $state=$request->km_state;
        //判斷輸入是否與預設有所不同
        if($og_state != $state)
        {
            //跑停用/顯示之流程:
            $this->activeable($id,$state);
        }


        session()->flash('message_update');
        return redirect()->back();

    }

    public function stateUpdate(Request $request)
    {
        //dd($request)->array();
        if($request->km_id !=NULL)
        {
            switch($request->form_state)
            {
                case "刪除":
                    $state=0;
                    for($i=0; $i< count($request->km_id); $i++)
                    {
                        $this->activeable($request->km_id[$i],$state);
                    }
                    session()->flash('message_update');
                    return redirect()->back();
                    break;

                case "正常":
                    $state=1;
                    for($i=0; $i< count($request->km_id); $i++)
                    {
                        $this->activeable($request->km_id[$i],$state);
                    }
                    session()->flash('message_update');
                    return redirect()->back();
                    break;

                case "停用":
                    $state=2;
                    for($i=0; $i< count($request->km_id); $i++)
                    {
                        $this->activeable($request->km_id[$i],$state);
                    }
                    session()->flash('message_update');
                    return redirect()->back();
                    break;
                case "還原":
                    $state=3;
                    for($i=0; $i< count($request->km_id); $i++)
                    {
                        $this->activeable($request->km_id[$i],$state);
                    }
                    session()->flash('message_update');
                    return redirect()->back();
                    break;
                case "永久刪除":
                    $state=4;
                    for($i=0; $i< count($request->km_id); $i++)
                    {
                        $this->activeable($request->km_id[$i],$state);
                    }
                    session()->flash('message_update');
                    return redirect()->back();
                    break;
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function mediaTag($media_keyword, $media_id)
    {
        for($i=0; $i<count($media_keyword); $i++)
        {
            $ky= new MediaTag ;
            $ky->km_id=$media_id;
            $ky->bp_tag_id=$media_keyword[$i];
            $ky->save();
        }
    }

    public function mediaDelete(Request $request)
    {

       dd($request->km_id)->array();
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
}
