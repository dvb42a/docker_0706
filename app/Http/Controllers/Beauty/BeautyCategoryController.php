<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Beauty\CategoryRequest;
use App\Models\Beauty\Category;
use App\Models\Beauty\Categorygp;
use App\Models\Beauty\Tag;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BeautyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.beauty.category.index');
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
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->bp_category =$request->bp_category;
        $category->save();
        session()->flash('message');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::where('bp_category_id',$id)->first();


        return view('admin.beauty.category.edit', compact('category'));
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
        $validator = Validator::make($request->all(), [
            'bp_category'=> ['string', 'max:25',Rule::unique('bp_category_sys','bp_category')->ignore($id, 'bp_category_id')],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category=Category::where('bp_category_id',$id)->first();
        $category->bp_category=$request->bp_category;
        $category->save();

        $currentOwnHashtags=CategoryGP::where('bp_category_id',$id)->get();
        $newHashtag=$request->bp_tag_id;
        //dd($newHashtag);
        if($newHashtag== NULL)
        {
            foreach($currentOwnHashtags as $currentOwnHashtag)
            {
                $currentOwnHashtag->delete();
            }
        }
        else
        {
            foreach($currentOwnHashtags as $currentOwnHashtag)
            {
                $deletingHashtag=$currentOwnHashtag->bp_tag_id;
                if(!in_array($deletingHashtag,$newHashtag))
                {
                    CategoryGP::where('bp_categorygp_id', $currentOwnHashtag->bp_categorygp_id)->delete();
                }
            }

            foreach($newHashtag as $needToCreateKeyword)
            {
                $existingKeyword=$currentOwnHashtags->where('bp_tag_id',$needToCreateKeyword)->first();
                if(!$existingKeyword or empty($currentOwnHashtags))
                {
                    CategoryGP::create(['bp_category_id'=>$id,
                                            'bp_tag_id'=>$needToCreateKeyword,
                                        ]);
                }
            }
        }

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
         //Transaction start
        DB::transaction(function() use($id)  {
            //step 1 : Delete all the linked data (keyowrd relation)
            DB::table('bp_category_gp')->where('bp_category_id',$id)->delete();
            //step 2 : Delete the Category data
            $category = Category::find($id);
            $category->delete();
            session()->flash('message_delete');
        });
        return redirect()->back();
    }
}
