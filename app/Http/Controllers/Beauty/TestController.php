<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\Content;
use App\Models\Beauty\Banner;
use App\Models\BeautyMirror\Standard;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Admin;
use App\Models\Role;
use App\Models\ModelRole;

use App\Http\Controllers\api\chapterController;

class TestController extends Controller
{


    public function test_return()
    {

        $e=123;
        return($e);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::where('name','admin_a')->with('modelrole')->get();
        //dd($roles);
        $admins=Role::where('name','admin_a')->withwhereHas('admins')->first();
        //dd($admins);

        return view('admin.beauty.test.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=Section::where('bp_chapter_id',7)->with('Tag')->orderBy('bp_section_sequence','asc')->get();
        //dd($sections)->array();
        return view('admin.beauty.test.create',compact('sections'));
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
        Test::updateOrCreate(['test_name'=> $request->test_name],['test_points'=>$request->test_points]);
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

    public function test_chaptertab()
    {
        $section_1=DB::table('bp_hashtag_sys')
        ->select( 'bp_hashtag_sys.bp_hashtag')
        ->rightJoin('bp_section','bp_hashtag_sys.bp_tag_id','=','bp_section.bp_tag_id')
        ->where('bp_chapter_id','=',1)
        ->get();
        //dd($section_1);
        return view ('admin.beauty.test.test_chaptertab',compact('section_1'));
    }

    public function imageUpload()
    {
        return view('admin.beauty.test.test_imageUpload');
    }

    public function iframe()
    {
        return view('admin.beauty.test.iframe');
    }

    public function ckeditor()
    {
        return view('admin.beauty.test.ckeditor');
    }
}
