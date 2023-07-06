<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Category;
use App\Models\Beauty\Categorygp;
use DB;

class categorytable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchInput='';
    public $paginationNum=10;
    public $sortByColumnName="(bp_category_id)";
    public $sortDirection="desc";
    public $byTime=null;
    public $byCount=null;
    public $bp_hashtag='';



    public function render()
    {
        $categorys=Category::withCount('CategoryGP')
        ->where('bp_category','like','%'.$this->searchInput.'%')
        ->orderByRaw($this->sortByColumnName .$this->sortDirection)
        ->paginate($this->paginationNum);
        //dd($categorys);
        return view('livewire.category-table',['categorys'=>$categorys ]);
    }

    public function updatedByTime()
    {
        $this->sortByColumnName="(bp_category_id)";
        switch($this->byTime)
        {
            case("desc"):
                $this->sortDirection="desc";
                break;
            case("asc"):
                $this->sortDirection="asc";
                break;
        }
    }

    public function updatedByCount()
    {
        //dd($this->byCount);
        $this->sortByColumnName="(category_g_p_count)";
        switch($this->byCount)
        {
            case("desc"):
                $this->sortDirection="desc";
                break;
            case("asc"):
                $this->sortDirection="asc";
                break;
        }
    }

    public function updatedsearchInput()
    {
        $this->resetpage();
    }

    public function deletedBy($deletedby)
    {
        DB::table('bp_category_gp')->where('bp_category_id',$deletedby)->delete();
        $category=Category::where('bp_category_id',$deletedby)->delete();

/*         $tag=Tag::where('bp_tag_id',$deletedby)
        ->withCount(['content_hashtag','mediaTag','section'])
        ->first();
        //dd($tag);
        if($tag->content_hashtag_count == 0 && $tag->media_tag_count ==0 && $tag->section_count==0)
        {
            //未有任何關連
            //dd('can');
            $tag->delete();
            $this->dispatchBrowserEvent('deleteSuccess');
        }
        else
        {
            //已經被關連時
            //dd('cannot');
            if($tag->section_count !=0)
            {
                $this->dispatchBrowserEvent('deleteFailed_section');
            }
            else
            {
                $this->dispatchBrowserEvent('deleteFailed');
            }

           //session()->flash()->withErrors('關鍵字已被使用，無法刪除。');
        } */
    }

    public function update()
    {
        dd($this->bp_hashtag);
    }

    public function reset_button()
    {
        $this->sortByColumnName="(bp_category_id)";
        $this->sortDirection="desc";
        $this->byTime=null;
        $this->byCount=null;
    }


}
