<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\Content;
class contenttrashtable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchInput='';
    public $paginationNum=13;
    public $sortByColumnName="deleted_at";
    public $sortDirection='desc';
    public $byState=null;
    public $whichpage="trash";

    public function render()
    {
        $contents=Content::whereIn('bp_subsection_state',[4])
        ->when($this->byState,function ($query){
            $query->where('bp_subsection_state',$this->byState);
        })
        ->where('bp_subsection_title','like','%'.$this->searchInput.'%')
        ->orderBy($this->sortByColumnName , $this->sortDirection)
        ->paginate($this->paginationNum);
        return view('livewire.contentAll-table',['contents'=>$contents ,'whichpage'=>$this->whichpage]);
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
