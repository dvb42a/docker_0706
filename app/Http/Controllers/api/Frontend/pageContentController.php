<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Content;
use App\Models\Beauty\Section;
use DB;

class pageContentController extends Controller
{
    public $paginate=10;

    public function kys($keywords)
    {
        $kys=[];
        foreach($keywords as $keyword)
        {
            array_push($kys,$keyword->bp_tag_id);
        }
        return $kys;
    }

    public function pageContent()
    {
        $keywords=Tag::withCount('content_hashtag')->orderBy('content_hashtag_count','desc')->take(10)->get();

        $contents=Content::where('bp_subsection_state','2')
        ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
        'bp_subsection.bp_subsection_intro','k_media_sys.km_name')
        ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
        ->orderBy('bp_subsection.created_at','desc')
        ->paginate($this->paginate);

        return response()->json([
            'keywords'=>$keywords,
            'contents'=>$contents], 200);
    }

    public function pageContentChapter($id)
    {
        $keywords=Section::where('bp_section.bp_chapter_id',$id)
        ->select('bp_hashtag_sys.bp_tag_id','bp_hashtag_sys.bp_hashtag')
        ->join('bp_hashtag_sys','bp_hashtag_sys.bp_tag_id','bp_section.bp_tag_id')
        ->get();
        $kys=$this->kys($keywords);

        $contents=Content_Hashtag::whereIn('bp_subsection_hashtag.bp_tag_id',($kys))
        ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
        'bp_subsection.bp_subsection_intro','k_media_sys.km_name')
        ->where('bp_subsection.bp_subsection_state','2')
        ->join('bp_subsection','bp_subsection.bp_subsection_id','bp_subsection_hashtag.bp_subsection_id')
        ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
        ->paginate($this->paginate);
        //$contents='';

        return response()->json(['keywords'=>$keywords , 'contents'=>$contents],200);
    }

    public function pageContentKeyword($id)
    {
        $keyword=Content_hashtag::where('bp_subsection_hashtag.bp_tag_id',$id)
        ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
        'bp_subsection.bp_subsection_intro','k_media_sys.km_name')
        ->where('bp_subsection.bp_subsection_state','2')
        ->join('bp_subsection','bp_subsection.bp_subsection_id','bp_subsection_hashtag.bp_subsection_id')
        ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
        ->paginate($this->paginate);

        return response()->json(['contents'=>$keyword],200);
    }

    public function pageContentArticle($id)
    {


        $content=Content::where('bp_subsection.bp_subsection_id',$id)
        ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
        'bp_subsection.bp_subsection_intro','k_media_sys.km_name','bp_subsection_cnt.bp_subsectioncnt_index')
        ->join('bp_subsection_cnt','bp_subsection_cnt.bp_subsection_id','bp_subsection.bp_subsection_id')
        ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
        ->get();

        $keywords=Content_hashtag::where('bp_subsection_id',$id)
        ->select('bp_hashtag_sys.bp_hashtag','bp_hashtag_sys.bp_tag_id')
        ->join('bp_hashtag_sys','bp_hashtag_sys.bp_tag_id','bp_subsection_hashtag.bp_tag_id')
        ->get();

        $kys=$this->kys($keywords);
        $kys=$kys[rand(0,count($kys)-1 )];

        $suggests_contents=Content_hashtag::where('bp_tag_id',$kys)
            ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
            'bp_subsection.bp_subsection_intro','k_media_sys.km_name')
            ->join('bp_subsection','bp_subsection_hashtag.bp_subsection_id','=','bp_subsection.bp_subsection_id')
            ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
            ->orderBy('bp_subsection.bp_subsection_enabled_date','desc')
            ->take(5)
            ->get();

        return response()->json(['content'=>$content,
                                'keywords'=>$keywords,
                                'suggests'=>$suggests_contents],200);
    }
}
