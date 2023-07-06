<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\File as Filecheck;
use File;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use App\Models\Beauty\Media;
use App\Models\Beauty\Setting;
use App\Models\Beauty\MediaCategory;
use App\Models\Beauty\Banner;


class BeautybannerSettingController extends Controller
{
    public $file=88; //廣告圖片的資料夾ID
    public $banner_maxCount=5; //廣告的上限為多少
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::with('media')->get();
        $setting=MediaCategory::find($this->file);
        $sys_setting=Setting::where('bps_id',1)->first();
        return view('admin.beauty.bannersetting.index',compact('setting','banners','sys_setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $setting=Setting::where('bps_id',1)->first();
        $setting->bps_bannerswitch=$request->banner_switch;
        $setting->save();

        for($i=0; $i<5; $i++)
        {

            //print("file_".$i);
            $file="file_".$i;
            $km_cname="km_cname".$i;
            $km_link="km_link".$i;
            $first="first".$i;
            $id="id".$i;
            $deleted_img="deleted_img_".$i;
            //dd($request->deleted_img);


            if($request->$deleted_img =="deleted" and $request->$file == NULL)
            {
                //清空該格所有的欄位
                $id=$request->$id;
                $status=$this->updateStatus($id);
                $save_position_data=MediaCategory::find($this->file);
                $media=Media::where('km_id',$id)->first();
                //dd($media);
                $save_position_address=$save_position_data->kmc_position;
                $save_location= "media/". $save_position_address ."/". $media->km_name;
                $media->km_cname="";
                $media->km_name="";
                $media->save();
                //$delete_location="media/trash/".$img->km_name;
                File::delete($save_location);
            }
            else
            {
                if($request->$km_cname != null  or  $request->$km_link != null)
                {
                    $validatedData = $request->validate([
                        $km_cname => ['required', 'string', 'max:25',Rule::unique('k_media_sys','km_cname')->ignore($request->$id, 'km_id')],
                        $km_link => ['required','string', 'max:100'],
                    ]);
                    if($request->$file !=null)
                    {
                        $file=$request->$file;
                        $km_name=$request->$km_cname;
                        $km_link=$request->$km_link;
                        $first=$request->$first;
                        $id=$request->$id;

                        $media=Media::where('km_id',$id)->first();
                        $save_position_data=MediaCategory::find($this->file);
                        $save_position_address=$save_position_data->kmc_position;
                        $save_location= "media/". $save_position_address ."/". $media->km_name;
                        File::delete($save_location);

                        $media_0=$this->media($file,$id,$km_link,$first,$km_name,$request);
                    }
                    else
                    {
                        $id=$request->$id;
                        $media=Media::where('km_id',$id)->first();
                        $media->km_cname=$request->$km_cname;
                        $media->save();
                        //dd($media);

                        if($request->$km_link !=null)
                        {
                            $link=$request->$km_link;
                            $banner=$this->updateLink($id,$link);
                        }
                        $first=$request->$first;
                        $updatefirst=$this->updateFirst($id,$first);
                    }
                }
            }
        }
        session()->flash('message_save');
        return redirect()->route('bannersetting.index');
    }

    public function media($file,$id,$km_link,$first,$km_name,$request)
    {

        $img_og_name=$file->getClientOriginalName();
            //圖片大小
            $img_size=$file->getSize();
            //讀取圖片尺寸
            $img_data=getimagesize($file);
            //寬
            $width=$img_data[0];
            //高
            $height=$img_data[1];
            //時間 格式:20221102
            $date= Carbon::now()->format('Ymd');
            //request 自訂名稱
            $img_rename=$km_name;
            //抓取圖片之類型
            $type=".".$file->extension();
            //存檔時最終取用之名稱
            $img_final_name=$date."_".$img_rename.$type;


            //讀取資料夾內容
            $save_position_data=MediaCategory::find($this->file);
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
/*             $this->validate($request,[
                'file_0','file_1','file_2','file_3','file_4'=>
                        Filecheck::types(['jpg','png','jepg'])->max($setting_size),
            ]);

            if($setting_width !=NULL and $setting_height!=NULL)
            {
                $this->validate($request,[
                    'file_0','file_1','file_2','file_3','file_4' =>
                            Rule::dimensions()->width($setting_width)->height($setting_height),
                ]);
            }
 */

            DB::transaction(function() use($file,$img_rename, $img_final_name, $id,$km_link,$first, $img_size, $width, $height, $save_location,$save_position_data)  {

                //save data

                $media=Media::where('km_id',$id)->first();
                $media->km_cname=$img_rename;
                $media->km_name=$img_final_name;
                $media->kmc_id=$this->file;
                $media->km_state= 1;
                $media->km_size = $img_size;
                $media->km_mediawidth= $width;
                $media->km_mediaheight= $height;
                $media->created_at = date('Y-m-d H:i:s');
                $media->save();
                $media_id = $media->km_id;

                $banner=Banner::where('km_id',$media_id)->first();
                $banner->km_id=$media_id;
                $banner->bpb_link=$km_link;
                $banner->bpb_first=$first;
                $banner->bpb_disabled="";
                $banner->save();

                //if($request->file[$i])
                $file->move(public_path($save_location), $img_final_name);
            });

    }

    public function updateLink($id,$link)
    {
        $banner=Banner::where('km_id',$id)->with('media')->first();
        $banner->bpb_link=$link;
        $banner->save();
    }

    public function updateFirst($id,$first)
    {
        $banner=Banner::where('km_id',$id)->first();
        $banner->bpb_first=$first;
        $banner->save();
    }

    public function updateStatus($id)
    {
        $banner=Banner::where('km_id',$id)->first();
        $banner->bpb_disabled=1;
        $banner->bpb_link="";
        $banner->bpb_first="";
        $banner->save();
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
    public function update(Request $request, $id)
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
}
