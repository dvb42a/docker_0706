<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_hashtag;

class contentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chapter=$request->chapter;
        if($chapter == '')
        {
            $contents=Content::where('bp_subsection_state','2')
                    ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title','bp_subsection.bp_subsection_intro','k_media_sys.km_name')
                    ->join('k_media_sys','k_media_sys.km_id','bp_subsection.km_id')
                    ->where('bp_subsection_title','like','%'.$request->title.'%')
                    ->paginate(15);
        }
        else
        {
            $contents=Chapter::where('bp_chapter.bp_chapter_id',$chapter)
            ->select('bp_subsection.bp_subsection_id','bp_subsection.bp_subsection_title','bp_subsection.bp_subsection_intro','k_media_sys.km_name')
            ->join('bp_section','bp_chapter.bp_chapter_id','=','bp_section.bp_chapter_id')
            ->join('bp_subsection_hashtag','bp_subsection_hashtag.bp_tag_id','bp_section.bp_tag_id')
            ->join('bp_subsection','bp_subsection.bp_subsection_id','bp_subsection_hashtag.bp_subsection_id')
            ->join('k_media_sys','bp_subsection.km_id','k_media_sys.km_id')
            ->where('bp_subsection.bp_subsection_state',2)
            ->where('bp_subsection_title','like','%'.$request->title.'%')
            ->paginate(15);
        }


        return response()->json($contents, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content=Content::where('bp_subsection_id',$id)
                ->select('bp_subsection_title','bp_subsection_intro','bp_subsection_id','km_id')
                ->with('ApiContentIndex','ApiMedia')
                ->get();

        return response()->json($content, 200);
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
