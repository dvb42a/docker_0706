<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaCategory;
class mediatrashtable extends Component
{
    use WithPagination;

    //public $sections;
    public $media_id;
    public $searchMedia='';
    public $paginationNum=8;
    public $sortByColumnName="km_id";
    public $sortDirection='desc';

    public function render()
    {
        $images=Media::
        with('MediaCategory')
        ->where('km_name','like','%'.$this->searchMedia.'%')
        ->whereIn('km_state',[0])
        ->orderBy($this->sortByColumnName ,$this->sortDirection)
        ->paginate($this->paginationNum);
        $this->dispatchBrowserEvent('contentChanged');
        //dd($images)->array();
        return view('livewire.media-trash',['images'=>$images]);

    }


    public function updatedsearchMedia()
    {
        $this->resetpage();
    }

    public function refreshPage()
    {
       $this->updatedsearchMedia();
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

}
