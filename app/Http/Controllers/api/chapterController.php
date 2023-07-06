<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Content;
use App\Models\Beauty\Section;
use DB;

class chapterController extends Controller
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

            if($request!=NULL)
            {
                //洗掉原先資料表的ID 順序
                DB::table('bp_section')->truncate();

                //chapter 1 的記錄
                for($i=0; $i<count($request->ky_array1);$i++)
                {
                    $new_section = new Section;
                    $new_section->bp_chapter_id = 1;
                    $new_section->bp_tag_id = $request->ky_array1[$i];
                    $new_section->save();
                }
                //chapter 2 的記錄
                for($i=0; $i<count($request->ky_array2);$i++)
                {
                    $new_section = new Section;
                    $new_section->bp_chapter_id = 2;
                    $new_section->bp_tag_id = $request->ky_array2[$i];
                    $new_section->save();
                }
                //chapter 3 的記錄
                for($i=0; $i<count($request->ky_array3);$i++)
                {
                    $new_section = new Section;
                    $new_section->bp_chapter_id = 3;
                    $new_section->bp_tag_id = $request->ky_array3[$i];
                    $new_section->save();
                }

                $sucess="true";

                return response()->json($sucess, 200);
            }



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

    public function saved_drift()
    {
        $chapters=Chapter::count();
        for($i=1 ; $i<$chapters; $i++)
        {
            $sections[]=DB::table('bp_hashtag_sys')
            ->select(
                'bp_section.bp_tag_id',
                'bp_hashtag_sys.bp_hashtag',
            DB::raw("(SELECT count(*)  from bp_subsection_hashtag where bp_subsection_hashtag.bp_tag_id = bp_section.bp_tag_id) as content_hashtag_count")
            )
            ->rightJoin('bp_section','bp_hashtag_sys.bp_tag_id','=','bp_section.bp_tag_id')
            ->where('bp_chapter_id','=',$i)
            ->get();
        }
        $sections = Tag:: selectRaw('bp_tag_id,bp_hashtag')->withCount('Content_hashtag')->get();
        //可用 有抓chapter name / chapter_id
        $sections = DB::table('bp_hashtag_sys')
        ->select('bp_hashtag_sys.bp_tag_id', 'bp_hashtag_sys.bp_hashtag',
        DB::raw("(SELECT count(*) from bp_subsection_hashtag where bp_subsection_hashtag.bp_tag_id=bp_section.bp_tag_id ) as content_hashtag_count"),
        'bp_chapter.bp_chapter_id','bp_chapter.bp_chapter_name')
        ->rightJoin('bp_section','bp_hashtag_sys.bp_tag_id','=','bp_section.bp_tag_id')
        ->join('bp_chapter','bp_chapter.bp_chapter_id','=','bp_section.bp_chapter_id')
        ->get();

        //測試用
        //$sections=Chapter::with('Tag')->get();
        //dd($section);
    }

}
