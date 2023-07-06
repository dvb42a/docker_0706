<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beauty\Tag;
use App\Models\Beauty\CategoryGP;
use App\Models\Beauty\Category;
use DB;

class categoryController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hashtags=DB::table('bp_category_gp')
        ->select('bp_category_gp.bp_tag_id','bp_hashtag_sys.bp_hashtag')
        ->where('bp_category_gp.bp_category_id','=',$id)
        ->leftjoin('bp_hashtag_sys', 'bp_hashtag_sys.bp_tag_id', '=', 'bp_category_gp.bp_tag_id')
        ->get();

        return response()->json($hashtags, 200);

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
