<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaCategory;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_index;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\MediaTag;
use App\Models\Beauty\Chapter;
use App\Http\Requests\Beauty\ContentRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Illuminate\Validation\Rules\File as Filecheck;
use App\Http\Controllers\Beauty\BeautyMediaController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class BeautyContentManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections =Chapter::with(['tag' =>function($query)
        {
            $query->withCount('content');
        }])->get();
        $contents=Content::whereNotIn('bp_subsection_state',[4])->count();
        $trash=Content::whereIn('bp_subsection_state', [4])->count();
        //dd($sections)->array();
        return view('admin.beauty.content.index',compact('contents','sections','trash'));
    }

    public function contentindexAll()
    {
        return view('admin.beauty.content.indexAll');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content_image_file=MediaCategory::where('kmc_name','文章圖片')->first();
        $medias=Media::with('MediaCategory')->where('km_state','1')->where('kmc_id',$content_image_file->kmc_id)->get();
        $setting=MediaCategory::where('kmc_position', 'content_banner_image')->first();
        return view('admin.beauty.content.create',compact('medias','setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //檢查標題是否已經被輸入
        $validated= $request->validate([
            'bp_subsection_title' =>['required','string','max:100','unique:bp_subsection'],
        ]);
        $content= new Content;
        $content->bp_subsection_title= $request->bp_subsection_title;
        $content->k_id =Auth::guard('admin')->user()->id;
        $content->created_at=date('Y-m-d H:i:s');
        $content->updated_at=date('Y-m-d H:i:s');
        $content->bp_subsection_state=0;
        $content->save();
        $content_id=$content->bp_subsection_id;

        $content_cnt=new Content_index;
        $content_cnt->bp_subsection_id=$content->bp_subsection_id;
        $content_cnt->created_at=date('Y-m-d H:i:s');
        $content_cnt->save();

        return redirect()->route('content.edit',$content_id);


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
        //抓目前當筆的資料/上傳圖片規範/媒體庫
        $saved_content=Content::with('Content_index')->where('bp_subsection_id',$id)->first();
        $first_image=Media::where('km_id',$saved_content->km_id)->first();
        $setting=MediaCategory::where('kmc_position', 'content_banner_image')->first();
        $content_image_file=MediaCategory::where('kmc_name','文章圖片')->first();
        $medias=Media::with('MediaCategory')->where('km_state','1')->where('kmc_id',$content_image_file->kmc_id)->get();
        //dd($saved_content)->array();
        return view('admin.beauty.content.edit',compact('saved_content','setting','medias','first_image'));
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
        //dd($request)->array();
        if($request->checked_date !=NULL)
        {
            //判斷是否只勾選排程卻忘記輸入日期及時間
            if($request->post_date==NULL)
            {
                return redirect()->back()->withErrors('請輸入有效日期及時間。')->withinput($request->input());
            }
        }
        //switch for 儲存/送出
        switch($request->submit_type)
        {
            case "preview":
            {

                $savedata=$this->update_savedata($request,$id);
                session()->flash('preview');
                return redirect()->route('content.edit',$savedata);
                //break;
            }
            case "save":
            {

                $savedata=$this->update_savedata($request,$id);
                session()->flash('message_save');
                return redirect()->route('content.edit',$savedata);
                //break;
            }
            case "submit":
            {

                //判斷有圖片時，運行下方code
                if($request->file != NULL )
                {
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
                    //重新命名
                    $img_rename=date('YmdHis');
                    //抓取圖片之類型
                    $type=".".$request->file->extension();
                    //存檔時最終取用之名稱
                    $img_final_name=$img_rename.$type;

                    //讀取資料夾內容
                    $save_position_data=MediaCategory::where('kmc_name','文章首圖')->first();
                    //正常圖片之存放路徑設定
                    $save_position_address=$save_position_data->kmc_position;
                    $save_location= "media/". $save_position_address."/";
                    //縮小圖片之存放路徑設定
                    $save_location_ziped=$save_location."/small/";
                    //圖片檔案大小上限
                    $setting_size=$save_position_data->kmc_file_limited;
                    $setting_size=$setting_size*1024;
                    $setting_width=$save_position_data->kmc_width;
                    $setting_height=$save_position_data->kmc_height;

                    $this->validate($request,[
                        'file' => Rule::dimensions()->width($setting_width)->height($setting_height),
                                    Filecheck::types(['jpg','png','jepg'])->max($setting_size),
                    ]);
                }
                //驗證資料真實性
                $validated= $request->validate([
                    'post_date' => ['nullable','date'],
                    'bp_subsection_member_only'=>['integer',Rule::in(['0','1'])],
                    'bp_display_rating'=>['integer'], // waiting for the develop update
                    'bp_subsection_intro' =>['required','string','max:255'],
                    'bp_subsection_cnt' => ['required','string','max:10000'],
                    'display_state'=>['integer', Rule::in(['0','1'])],
                    'bp_subsection_state'=>['nullable','integer',Rule::in(['2','3'])],
                    'bp_type_keep'=>['integer',Rule::in(['1'])],
                    'bp_type_fix'=>['integer',Rule::in(['1'])],
                    'bp_type_info'=>['integer',Rule::in(['1'])],
                    'keywords'=>['required'],
                ]);

                //更新主題內容
                $content=Content::find($id);
                $media=Media::find($content->km_id);

                if($request->imgStatus == 'deleted')
                {
                    return redirect()->back()->withErrors('更新失敗:已發布狀態無法刪除首圖。')->withinput($request->input());
                }

                //判斷是否有加入圖片
                if($request->file != NULL)
                {
                    $img_upload=$this->imageupload($img_rename, $img_final_name, $request , $img_size, $width, $height, $save_location,$save_position_data);
                    if($content->km_id!= NULL)
                    {
                        $img_delete=$save_location.$media->km_name;
                        $img_delete_zip=$save_location_ziped.$media->km_name;
                        File::delete($img_delete);
                        File::delete($img_delete_zip);
                        $media->delete();
                    }
                    $content->km_id=$img_upload;
                }
                else
                {
                    if($content->km_id ==NULL)
                    {
                        return redirect()->back()->withErrors('請上傳文章首圖。')->withinput($request->input());
                    }
                }
                //dd($media_sent)->array();
                $content->bp_subsection_title=$request->bp_subsection_title;
                $content->bp_subsection_intro=$request->bp_subsection_intro;
                //$content->bp_display_rating=$request->bp_display_rating;

                //dd($request);
                //判斷是否勾選排程
                if($content->bp_subsection_state != 2 or $content->bp_subsection_state !=3)
                {
                    if($request->checked_date !=NULL)
                    {
                        //判斷是否有選擇排程之日期及時間
                        if($request->post_date==NULL)
                        {
                            return redirect()->back()->withErrors('請輸入有效日期及時間。')->withinput($request->input());
                        }
                        else
                        {
                            $datecheck=str_replace('T',' ',$request->post_date);
                            if($datecheck <= date('Y-m-d H:i:s'))
                            {
                                $content->bp_subsection_state = 2;
                                $content->bp_subsection_enabled_date=date('Y-m-d H:i:s');
                            }
                            else
                            {
                                $content->bp_subsection_state=1;
                                $content->bp_subsection_enabled_date=$request->post_date;
                            }
                        }
                    }
                    else
                    {
                        $content->bp_subsection_state = 2;
                        $content->bp_subsection_enabled_date=date('Y-m-d H:i:s');
                    }
                }

                if($request->bp_subsection_state ==3)
                {
                    $content->bp_subsection_state=$request->bp_subsection_state;
                }

                //dd($request->bp_subsection_state);
                $content->bp_subsection_member_only=$request->bp_subsection_member_only;
                $content->k_id=Auth::guard('admin')->user()->id;
                $content->updated_at= date('Y-m-d H:i:s');
                $content->save();

                //抓取已更新之那一筆的id
                $content_id=$content->bp_subsection_id;

                //更新content
                $content_cnt=Content_index::where('bp_subsection_id',$id)->first();
                $content_cnt->bp_subsection_id=$content->bp_subsection_id;
                $content_cnt->bp_subsectioncnt_index=$request->bp_subsection_cnt;
                $content_cnt->updated_at=date('Y-m-d H:i:s');
                $content_cnt->save();

                $content_keyword=$request->keywords;
                $this->contentTag($content_keyword,$content_id,$request->bp_type_keep,$request->bp_type_fix,$request->bp_type_info);
                session()->flash('message_posted');
                return redirect()->route('content.edit',$content_id);

                break;
            }
        }

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

    //完整的程式於BeautyMediaController參考
    public function imageupload($img_rename, $img_final_name, $request , $img_size, $width, $height, $save_location,$save_position_data)
    {
        $media_sent=DB::transaction(function() use($img_rename, $img_final_name, $request , $img_size, $width, $height, $save_location,$save_position_data)  {
            //save data
            $media= new Media;
            $media->km_cname = $img_rename;
            $media->km_name = $img_final_name;
            $media->kmc_id = $save_position_data->kmc_id;
            $media->km_cnt = $request->bp_subsection_title;
            $media->km_state= 1;
            $media->km_size = $img_size;
            $media->km_mediawidth= $width;
            $media->km_mediaheight= $height;
            $media->created_at = date('Y-m-d H:i:s');
            $media->save();

            //save image

            //saving resize image if it selected resize
            if($save_position_data->kmc_resize !=0 )
            {
                $rate=(new BeautyMediaController)->ziped_rate();
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
            $media_id=$media->km_id;
            return($media_id);
        });
        return($media_sent);
        //dd($media_sent)->array();
    }

    public function preview($id)
    {
        $saved_content=Content::with('Content_index')->where('bp_subsection_id',$id)->first();
        $image=Media::find($saved_content->km_id);
        //dd($saved_content)->array();
        return view('admin.beauty.content.preview',compact('saved_content','image'));
    }

    //更新儲存之文章
    public function update_savedata($request,$id)
    {
        //dd($request)->array();
        //判斷是否有輸入標題
        $validated= $request->validate([
            'bp_subsection_title' =>['required','string','max:100',Rule::unique('bp_subsection')->ignore($id,'bp_subsection_id'),],
        ]);

        $savedata=DB::transaction(function() use($request,$id)  {
            $validated= $request->validate([
                'checked_date'=>['nullable'],
                'post_date' => ['nullable','date'],
                'bp_subsection_member_only'=>['integer',Rule::in(['0','1'])],
                'bp_display_rating'=>['nullable','integer'], // waiting for the develop update
                'bp_subsection_intro' =>['nullable','string','max:255'],
                //keyowrd[] <-
                'bp_subsection_cnt' => ['nullable','string','max:10000'],
                'display_state'=>['integer', Rule::in(['0','1'])],
                'bp_type_keep'=>['integer',Rule::in(['1'])],
                'bp_type_fix'=>['integer',Rule::in(['1'])],
                'bp_type_info'=>['integer',Rule::in(['1'])],
            ]);
            //dd($request->post_date);
            //新增主題內容
            $content=Content::find($id);
            $media=Media::find($content->km_id);

            //處理刪除原先已上存之圖片
            if($request->imgStatus == 'deleted')
            {
                //讀取資料夾內容
                $save_position_data=MediaCategory::where('kmc_name','文章首圖')->first();
                //正常圖片之存放路徑設定
                $save_position_address=$save_position_data->kmc_position;
                $save_location= "media/". $save_position_address."/";
                //縮小圖片之存放路徑設定
                $save_location_ziped=$save_location."/small/";

                $img_delete=$save_location.$media->km_name;
                //dd($img_delete);
                $img_delete_zip=$save_location_ziped.$media->km_name;
                File::delete($img_delete);
                File::delete($img_delete_zip);
                $content->km_id=null;
                $media->delete();
            }


            //處理有關於首圖首次上傳/二次上傳處理
            if($request->file != NULL)
            {
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
                //重新命名
                $img_rename=date('YmdHis');
                //抓取圖片之類型
                $type=".".$request->file->extension();
                //存檔時最終取用之名稱
                $img_final_name=$img_rename.$type;

                //讀取資料夾內容
                $save_position_data=MediaCategory::where('kmc_name','文章首圖')->first();
                //正常圖片之存放路徑設定
                $save_position_address=$save_position_data->kmc_position;
                $save_location= "media/". $save_position_address."/";
                //縮小圖片之存放路徑設定
                $save_location_ziped=$save_location."/small/";
                //圖片檔案大小上限
                $setting_size=$save_position_data->kmc_file_limited;
                $setting_size=$setting_size*1024;
                $setting_width=$save_position_data->kmc_width;
                $setting_height=$save_position_data->kmc_height;

                //dd($save_position_data)->array();
                $this->validate($request,[
                    'file' => Rule::dimensions()->width($setting_width)->height($setting_height),
                            Filecheck::types(['jpg','png','jepg'])->max($setting_size),
                ]);

                if($content->km_id!=NULL)
                {
                    $img_delete=$save_location.$media->km_name;
                    //dd($img_delete);
                    $img_delete_zip=$save_location_ziped.$media->km_name;
                    File::delete($img_delete);
                    File::delete($img_delete_zip);
                    $media->delete();
                    $content->km_id=NULL;
                }

                $img_upload=$this->imageupload($img_rename, $img_final_name, $request , $img_size, $width, $height, $save_location,$save_position_data);
                //當原先已有圖片時，如何處理舊的圖片

                $content->km_id=$img_upload;
            }
            //dd($media_sent)->array();
            $content->bp_subsection_title=$request->bp_subsection_title;
            $content->bp_subsection_intro=$request->bp_subsection_intro;
            //$content->bp_display_rating=$request->bp_display_rating;
            //dd($request)->array();


            //判斷勾選排程
            if($request->checked_date !=NULL)
            {
                $content->bp_subsection_enabled_date=$request->post_date;
            }
            $content->bp_subsection_member_only=$request->bp_subsection_member_only;
            $content->k_id=Auth::guard('admin')->user()->id;
            $content->updated_at= date('Y-m-d H:i:s');
            $content->save();

            //抓取新增完成那一筆的id
            $content_id=$content->bp_subsection_id;
            //更新content
            $content_cnt=Content_index::where('bp_subsection_id',$id)->first();
            $content_cnt->bp_subsection_id=$content->bp_subsection_id;
            $content_cnt->bp_subsectioncnt_index=$request->bp_subsection_cnt;
            $content_cnt->updated_at=date('Y-m-d H:i:s');
            $content_cnt->save();

            //$content_keywords=Content_hashtag::where('bp_subsection_id',$content_id)->delete();
            $content_keyword=$request->keywords;
            $this->contentTag($content_keyword,$content_id,$request->bp_type_keep,$request->bp_type_fix,$request->bp_type_info);

            return($content_id);
        });
        //dd($savedata)->array();
        return($savedata);
    }

    //列表當中更新文章的狀態
    public function mutisetting(Request $request)
    {
        //dd($request);
        if($request->subsections != NULL)
        {
            $ids=$request->subsections;
            for($i=0; $i<count($ids); $i++)
            {
                $subsection=Content::find($ids[$i]);
                if($request->submit != 'destory')
                {
                    switch($request->submit)
                    {
                        case('hide'): //隱藏
                            if($subsection->bp_subsection_state == 2 )
                            {
                                $subsection->bp_subsection_Exstate=$subsection->bp_subsection_state;
                                $subsection->bp_subsection_state=3;
                                session()->flash('message_update');
                            }
                            else
                            {
                                session()->flash('errorHideSubsection');
                            }
                            break;

                        case('delete'): //刪除
                            if($subsection->bp_subsection_state == 0 || $subsection->bp_subsection_state ==3)
                            {
                                $subsection->bp_subsection_Exstate=$subsection->bp_subsection_state;
                                $subsection->deleted_at=date('Y-m-d H:i:s');
                                $subsection->bp_subsection_state=4;
                                session()->flash('message_update');
                            }
                            else
                            {
                                session()->flash('errorDeleteSubsection');
                            }
                            break;
                        case('show'): //顯示
                                $subsection->deleted_at=NULL;
                                if($subsection->bp_subsection_Exstate != 1 )//是否有排程
                                {
                                    if($subsection->bp_subsection_enabled_date !=null)
                                    {
                                        $subsection->bp_subsection_state=2;
                                        session()->flash('message_update');
                                    }

                                }
                                else
                                {
                                    if($subsection->bp_subsection_enabled_date <= date('Y-m-d H:i:s'))
                                    {
                                        $subsection->bp_subsection_state =0;
                                    }
                                    else
                                    {
                                        $subsection->bp_subsection_state =1;
                                    }
                                    session()->flash('message_update');
                                }
                                if($subsection->bp_subsection_Exstate==0)
                                {
                                    $subsection->bp_subsection_state=0;
                                }

                            break;
                        case('top'):
                            //dd($request->category);
                            $content =Content_Hashtag::where('bp_tag_id', $request->category)->where('bp_subsection_id',$ids[$i])->first();
                            //dd($content->bp_sh_id);
                            if($subsection->bp_subsection_state == 2)
                            {
                                $content->bp_display_top =1;
                                $content->save();
                                session()->flash('message_update');
                            }
                            else
                            {
                                return redirect()->back()->withErrors("非發布狀態的文章無法置頂。");
                            }
                            break;
                        case('cancelTop'):
                            $content =Content_Hashtag::where('bp_tag_id', $request->category)->where('bp_subsection_id',$ids[$i])->first();
                            $content->bp_display_top =NULL;
                            $content->save();
                            session()->flash('message_update');
                            break;
                    }
                    $subsection->save();

                }
                else
                {
                    //刪除
                    DB::transaction(function() use($subsection) {
                        /* $first_image= */
                        if($subsection->km_id != NULL)
                        {
                            $deleteImage=(new BeautyMediaController)->contentBannerDelete($subsection->km_id,4);
                        }
                        $subsection->content_index()->delete();
                        $subsection->content_hashtag()->delete();
                        $subsection->delete();
                        session()->flash('message_update');
                    });
                }
            }

        }
        return redirect()->back();
    }

    public function contentMedia()
    {
        $mediaFile=MediaCategory::where('kmc_name','文章圖片')->first();
        $medias=Media::where('kmc_id',$mediaFile->kmc_id)->with('MediaWithTag')->get();
        //dd($medias)->array();
        return view('admin.beauty.content.media',compact('medias'));
    }

    public function contentCkeditor($id)
    {
        $content_id=$id;
        return view('admin.beauty.content.ckeditor',compact('content_id'));
    }

    //新增關鍵字的功能
    public function contentTag($content_keyword,$content_id,$bp_type_keep,$bp_type_fix,$bp_type_info)
    {
        $currentOwnHashtags=Content_hashtag::where('bp_subsection_id',$content_id)->get();
        //檢查是否完全沒有輸入值

        if($content_keyword ==NULL)
        {
            //是 -> delete all
            foreach($currentOwnHashtags as $currentOwnHashtag)
            {
                $currentOwnHashtag->delete();
            }
        }
        else
        {
            //否-> 檢查每個Input

            //檢查是否與資料庫相同，沒有的話 delete
            foreach($currentOwnHashtags as $currentOwnHashtag)
            {
                $deletingHashtag=$currentOwnHashtag->bp_tag_id;
                if(!in_array($deletingHashtag,$content_keyword))
                {
                    Content_hashtag::where('bp_sh_id',$currentOwnHashtag->bp_sh_id)->delete();
                }
            }

            //將keep, top , info 加進已新增之關鍵字
            if($bp_type_fix != NULL or $bp_type_info!=null or $bp_type_keep)
            {
                foreach($currentOwnHashtags as $currentOwnHashtag)
                {
                    $updateStatus=Content_hashtag::where('bp_sh_id',$currentOwnHashtag->bp_sh_id)->first();
                    $updateStatus->bp_type_keep=$bp_type_keep;
                    $updateStatus->bp_type_fix=$bp_type_fix;
                    $updateStatus->bp_type_info=$bp_type_info;
                    $updateStatus->save();

                }
            }

            //把新的關鍵字新增
            foreach( $content_keyword as $needToCreatedKeyword)
            {
                $existingKeyword=$currentOwnHashtags->where('bp_tag_id',$needToCreatedKeyword)->first();
                if(!$existingKeyword or empty($currentOwnHashtags))
                {
                    Content_hashtag::create(['bp_subsection_id'=>$content_id,
                                            'bp_tag_id'=>$needToCreatedKeyword,
                                            'bp_type_keep'=>$bp_type_keep,
                                            'bp_type_fix'=>$bp_type_fix,
                                            'bp_type_info'=>$bp_type_info]);
                }
            }
        }
    }
}
