<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tests;
use App\Models\BeautyMirror\NormalInspection;
use App\Models\BeautyMirror\Standard;
use App\Models\Beaut\Tag;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Content;
use DB;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standard=Standard::where('bms_id','1')->with('Tag','Type')->first();
        //dd($standard);

        $num=rand(-90,90);
        //$num=50;
        //$num=5;
        $result=Standard::where('bp_tag_id','124')
        ->with('Tag','Type')
        ->where(function ($query) use ($num){
            $query->where('bms_lower', '<=', $num);
            $query->where('bms_upper', '>=', $num);
        })
        ->first();
        if($result ==NULL)
        {
            $result=Standard::where('bp_tag_id','124')
            ->orderBy('bms_lv','desc')
            ->first();
        }
        //dd($result);

        $bms_type=123;
        $detection_id=129;
        $contents=Content_hashtag::where('bp_tag_id',$detection_id)->select('bp_tag_id')->get();

        $simple_result=NormalInspection::all();
        //dd($simple_result);
        return view('admin.beauty.tests.index' ,compact('num','result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
