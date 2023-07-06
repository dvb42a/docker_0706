<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Section;
use App\Models\Beauty\Content;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Content_hashtag;

use DB;

class sectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Content::all();
        return response()->json($sections, 200);
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
        $keyword=Tag::where('bp_tag_id',$id)->first();
        $sections=Content_hashtag::where('bp_subsection_hashtag.bp_tag_id',$id)
        ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title',
        'bp_subsection.bp_subsection_intro','k_media_sys.km_name')
        ->join('bp_hashtag_sys','bp_hashtag_sys.bp_tag_id','bp_subsection_hashtag.bp_tag_id')
        ->join('bp_subsection','bp_subsection.bp_subsection_id','bp_subsection_hashtag.bp_subsection_id')
        ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
        ->paginate(15);

        return response()->json(['hashtag'=>$keyword, 'sections'=>$sections],200);
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
        $sections=Content::where('bp_subsection_state',4)->get();
        return response()->json($sections,200);
    }


}
