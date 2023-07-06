<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Beauty\TagRequest;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Content_hashtag;
use App\Models\Beauty\Chapter;
use App\Models\Beauty\MediaTag;
use App\Models\Beauty\Categorygp;
use DB;
use Illuminate\Support\Facades\Validator;
use PDO;

class BeautyKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //$tags=Tag::paginate(20);
        $tags=Tag::paginate(50);
        //dd($tags)->array();

        return view('admin.beauty.keyword.index',compact('tags'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.beauty.keyword.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $countOfTotalKeyword=count($request->bp_hashtag);
        $countOfSucess=0;

        $validator = Validator::make($request->all(), [
            'bp_hashtag.*'=> ['nullable','string', 'max:25','unique:bp_hashtag_sys,bp_hashtag'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        for($i=0; $i<count($request->bp_hashtag); $i++)
        {
            if($request->bp_hashtag[$i] != null)
            {
                $tag = new Tag;
                $tag->bp_hashtag =$request->bp_hashtag[$i];
                $tag->save();
            }
            $countOfSucess=$countOfSucess+1;
        }
        if($countOfTotalKeyword==$countOfSucess)
        {
            session()->flash('message');
        }
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
        $tag=Tag::where('bp_tag_id',$id)->first();
        return view('admin.beauty.keyword.main',compact('tag'));
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
    public function update(TagRequest $request, $id)
    {

        $tag = Tag::find($id);
        $tag->bp_hashtag = $request->bp_hashtag;
        $tag->save();
        session()->flash('message_update');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // at livewire
    }
}
