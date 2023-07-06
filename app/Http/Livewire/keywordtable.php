<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Categorygp;

class keywordtable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchInput='';
    public $paginationNum=24;
    public $sortByColumnName="(bp_tag_id)";
    public $sortDirection="desc";
    public $byTime=null;
    public $byCount=null;
    public $bp_hashtag='';



    public function render()
    {
        $keywords=Tag::withCount(['content_hashtag','mediaTag'])
        ->where('bp_hashtag','like','%'.$this->searchInput.'%')
        ->orderByRaw($this->sortByColumnName .$this->sortDirection)
        ->paginate($this->paginationNum);
        $this->dispatchBrowserEvent('keywordChanged');
        //dd($keywords);
        return view('livewire.keyword-table',['keywords'=>$keywords ]);
    }

    public function updatedByTime()
    {
        $this->sortByColumnName="(bp_tag_id)";
        switch($this->byTime)
        {
            case("desc"):
                $this->sortDirection="desc";
                break;
            case("asc"):
                $this->sortDirection="asc";
                break;
        }
        $this->byCount="";
    }

    public function updatedByCount()
    {
        //dd($this->byCount);
        $this->sortByColumnName="(content_hashtag_count + media_tag_count)";
        switch($this->byCount)
        {
            case("desc"):
                $this->sortDirection="desc";
                break;
            case("asc"):
                $this->sortDirection="asc";
                break;
        }
        $this->byTime="";
    }

    public function updatedsearchInput()
    {
        $this->resetpage();
    }

    public function deletedBy($deletedby)
    {
        $tag=Tag::where('bp_tag_id',$deletedby)
        ->withCount(['content_hashtag','mediaTag','section'])
        ->first();
        //dd($tag);
        if($tag->content_hashtag_count == 0 && $tag->media_tag_count ==0 && $tag->section_count==0)
        {
            //未有任何關連
            //dd('can');
            $tag->delete();
            $categoryGP=CategoryGP::where('bp_tag_id',$deletedby)->delete();
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
        }
    }

    public function update()
    {
        dd($this->bp_hashtag);
    }

    public function reset_button()
    {
        $this->byCount="";
        $this->byTime="";
        $this->sortByColumnName="(bp_tag_id)";
        $this->sortDirection="desc";
    }


}
