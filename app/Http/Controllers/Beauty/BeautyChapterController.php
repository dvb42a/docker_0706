<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Beauty\CategoryRequest;
use App\Models\Beauty\Category;
use App\Models\Beauty\Categorygp;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Section;
use DB;
use Illuminate\Support\Facades\Cookie;


class BeautyChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chapters= Chapter::all();
        $content_tags = Section::with('Tag')->get();
        //dd($chapterWithTag)->array();
        return view ('admin.beauty.chapter.index',compact('chapters','content_tags'));
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
        //dd($request)->array();
        $validated= $request->validate([
            'chapter' => ['qnique:bp_chapter,bp_chapter_name'],
        ]);
        $chapter = new Chapter ;
        $chapter->bp_chapter_name = $request->bp_chapter_name;
        $chapter->save();
        return redirect()->back();

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
    public function update(CategoryRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function save()
    {
        if($request->delete_function != NULL)
        {
            $chapterHashtag = Section::where('bp_tag_id',$request->delete_function);
            $position_change = $sections->where('bp_section_id',$chapterHashtag->bp_chapter_id)
            ->where('bp_section_sequence','>',$chapterHashtag->bp_section_sequence)
            ->update(['bp_section_sequence'=>\DB::raw('bp_section_sequence-1')]);

            $chapterHashtag->delete();
            return redirect()->back();
        }
/*         elseif($request->bp_section_sequence !=NULL)
        {
            //foreach($request->bp_seciton_sequence)
        } */
        else
        {
            $contentHastagLast=Section::first();
            //dd($contentHastagLast)->array();
            //dd($request)->array();
            foreach ($request->bp_tag_name as $tag)
            {
                if($tag!=NULL)
                {
                    $save_tag=$tag;
                    $tag_db=Tag::where('bp_hashtag',$tag)->first();
                    if($tag_db ==NULL)
                    {
                        return redirect()->back()->withErrors('無效關鍵字');
                    }
                }
            }
            //print($request->submit_chapter);
            $test=$sections->where('bp_chapter_id',$request->submit_chapter)->max('bp_section_sequence')+1;
            //dd($test)->array();
            $contentHashtag= new Section;
            $contentHashtag->bp_chapter_id=$request->submit_chapter;
            $contentHashtag->bp_tag_id=$tag_db->bp_tag_id;
            $contentHashtag->bp_section_sequence = $sections->where('bp_chapter_id',$request->submit_chapter)->max('bp_section_sequence')+1;
            $contentHashtag->save();

            return redirect()->back();
        }

    }
    public function hashtagCreate(Request $request ,Section $sections)
    {
        //dd($request);
        $tag= Tag::where('bp_hashtag', $request->keyword)->first();
        $section= new Section;
        $section->bp_chapter_id = $request->chapter;
        $section->bp_tag_id = $tag->bp_tag_id ;
        $section->save();
        session(['chapter',$request->chapter]);
        session()->flash('message');
        return redirect()->back();
    }
}
