<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Content;
use App\Models\Beauty\Section;
use App\Models\Beauty\Banner;
use DB;

class bannerController extends Controller
{
    public function bannerShow()
    {

        $banners=Banner::whereNotIn('bp_banner_sys.bpb_disabled',[1])
        ->select('bp_banner_sys.km_id','k_media_sys.km_cname','bp_banner_sys.bpb_link')
        ->join('k_media_sys','k_media_sys.km_id','bp_banner_sys.km_id')
        ->orderBy('bp_banner_sys.bpb_first','desc')->get();


        return response()->json(['banners'=>$banners], 200);
    }
}
