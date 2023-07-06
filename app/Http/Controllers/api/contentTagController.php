<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_hashtag;
use DB;

class contentTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $hashtags=Content_hashtag::where('bp_subsection_id',$request->content_id)->delete();
        if($request->keywordListID!=NULL)
        {
            for($i=0; $i<count($request->keywordListID);$i++)
            {
                $content = new Content_hashtag;
                $content->bp_subsection_id = $request->content_id;
                $content->bp_tag_id = $request->keywordListID[$i];
                $content->save();
            }
        }
        return response()->json($request, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content=Content_hashtag::where('bp_subsection_id',$id)->with('hashtag')->get();
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
