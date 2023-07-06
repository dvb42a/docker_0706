<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beauty\Section;
use App\Models\Beauty\Content;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Tag;
use DB;


class BeautySectionController extends Controller
{

    //------------------------------抓取資料----------------------------------------------

    public function all_subsection()
    {
        $all_subsection=content::all();
        return($all_subsection);
    }
    public function chapters()
    {
        $chapters =Chapter::with(['tag' =>function($query)
        {
            $query->withCount('content');
        }])->get();
        return($chapters);
    }

    public function delete_subsection_count($all_subsection)
    {
        $delete_subsection_count=count($all_subsection->where('bp_subsection_state',4));
        return($delete_subsection_count);
    }

    public function subsection_count($all_subsection)
    {
        $subsection_count=count($all_subsection->whereNotIn('bp_subsection_state',4));
        return($subsection_count);
    }


    //----------------------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_subsection=$this->all_subsection();
        $chapters=$this->chapters();
        $subsection_count=$this->subsection_count($all_subsection);
        $delete_subsection_count=$this->delete_subsection_count($all_subsection);
        $subsections=$all_subsection->whereNotIn('bp_subsection_state',4);
        return view('admin.beauty.section.index',compact('subsections','chapters','subsection_count','delete_subsection_count'));
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
        $sections =Chapter::with(['tag' =>function($query)
        {
            $query->withCount('content');
        }])->get();
        $section=Tag::find($id);
        $subsections=Content_hashtag::where('bp_tag_id',$id)
        ->withwhereHas('content', function($q){
            $q->where('bp_subsection_state','!=','4');
        })
        ->get();
        $contents=Content::whereNotIn('bp_subsection_state',[4])->count();
        $trash=Content::whereIn('bp_subsection_state', [4])->count();
        //dd($sections_id)->array();
        return view('admin.beauty.section.show',compact('subsections','contents','section','sections','trash'));
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

    public function softdeleteIndex()
    {
        $contents=Content::whereNotIn('bp_subsection_state',[4])->count();
        $sections =Chapter::with(['tag' =>function($query)
        {
            $query->withCount('content');
        }])->get();
        $trash=Content::whereIn('bp_subsection_state', [4])->count();
        return view('admin.beauty.section.softdeleteIndex',compact('contents','sections','trash'));
    }

}
