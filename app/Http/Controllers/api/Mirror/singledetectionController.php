<?php

namespace App\Http\Controllers\api\Mirror;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeautyMirror\NormalInspection;
use App\Models\BeautyMirror\Standard;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Content;
use App\Models\Beauty\Tag;
use DB;

class singledetectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content=Content::where('bp_subsection_id',$id)->with('Content_index')->with('hashtag')->first();
        return response()->json(['content'=>$content ]);
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

    public function delete()
    {

    }

    public function detectionShow(Request $request)
    {
        $rawdata=NormalInspection::where('bmni_id',$request->result_id)->first();
        $date=$rawdata->created_at;
        $user_data=$request->data;
        $detection_id=$request->detection_id;
        $standard=Standard::where('bp_tag_id',$detection_id)
            ->where(function($query) use ($user_data){
                $query->where('bms_lower','<=',$user_data);
                $query->where('bms_upper','>=',$user_data);
            })
            ->first();
        switch($standard->bms_type)
        {
            case(1):
                $detection_type='bp_type_keep';
                break;
            case(2):
                $detection_type='bp_type_fix';
                break;
            case(3):
                $detection_type='bp_type_info';
                break;
        }
        $contents=Content_hashtag::where('bp_tag_id',$detection_id)
            //->with('ApiContent','ApiMedia')
            ->orderBy($detection_type,'desc')
            ->select('bp_subsection_hashtag.*')
            ->join('bp_subsection','bp_subsection_hashtag.bp_subsection_id','=','bp_subsection.bp_subsection_id')
            ->orderBy('bp_subsection.bp_subsection_enabled_date','desc')
            ->withWhereHas('ApiContent')
            ->with('ApiMedia')
            ->take(5)
            ->get();

        if(count($contents) <=2)
        {
            $count=3-count($contents);
            if($count <=0)
            {
                $count=0;
            }
            $contents_withoutKeyword=Content_hashtag::
            whereNotIn('bp_tag_id',[$detection_id])
            ->with('ApiContent','ApiMedia')
            ->orderBy('bp_sh_id','desc')
            ->take($count)
            ->get();

            $result_contents=$contents->merge($contents_withoutKeyword);
        }
        else
        {
            $result_contents=$contents;
        }



        return response()->json([
            'date'=>$date,
            'user_data'=>$user_data,
            'standard'=>$standard,
            'suggests_contents'=>$result_contents,
        ]);
    }

}
