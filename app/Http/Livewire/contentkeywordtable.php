<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_hashtag;
class contentkeywordtable extends Component
{
    use WithPagination;

    //public $sections;
    public $content_id;
    public $searchInput='';
    public $paginationNum=10;
    public $sortByColumnName="updated_at";
    public $sortDirection='desc';
    public $byState=null;

    public function render()
    {
/*          $contents=Content::whereNotIn('bp_subsection_state',[4])
        ->when($this->byState,function ($query){
            $query->where('bp_subsection_state',$this->byState);
        })
        ->where('bp_subsection_title','like','%'.$this->searchInput.'%')
        ->orderBy($this->sortByColumnName , $this->sortDirection)
        ->get(); */

        $contents=Content_hashtag::where('bp_tag_id',$this->content_id)
        ->join('bp_subsection','bp_subsection.bp_subsection_id','=','bp_subsection_hashtag.bp_subsection_id')
        ->orderBy('bp_subsection.'.$this->sortByColumnName,$this->sortDirection)
        ->withwhereHas('content', function($q){
            //$q->where('bp_subsection_state','!=','4');
            $q->where('bp_subsection_title','like','%'.$this->searchInput.'%');
            $q->when($this->byState,function($query){
                $query->where('bp_subsection_state',$this->byState);
            });
            //$q->orderBy($this->sortByColumnName,$this->sortDirection);
        })

        ->paginate($this->paginationNum);
        //dd($contents);
        return view('livewire.contentKeyword-table',['contents'=>$contents , 'content_id'=>$this->content_id]);
    }

    public function sortBy($columnname)
    {
        $this->sortDirection=$this->swapSortDirection();
        $this->sortByColumnName = $columnname;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc' ;
    }

    public function updatedsearchInput()
    {
        $this->resetpage();
    }

}
