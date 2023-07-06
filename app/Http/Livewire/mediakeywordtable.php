<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaTag;
use App\Models\Beauty\MediaCategory;
class mediakeywordtable extends Component
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
        //$setting=MediaCategory::find($this->media_id);
        $images=MediaTag::where('bp_tag_id' ,$this->media_id)
        ->join('k_media_sys','k_media_sys.km_id','=','k_media_tag.km_id')
        ->orderBy('k_media_sys.'.$this->sortByColumnName ,$this->sortDirection)
        ->withwhereHas('Media' , function ($query) {
            $query->where('km_name','like','%'.$this->searchMedia.'%');
            //$query->whereNotIn('km_state', [0]);
            $query->with('MediaCategory');
            $query->with('MediaWithTag');
            //$query->orderBy($this->sortByColumnName ,$this->sortDirection);
        })
        ->paginate($this->paginationNum);

        //->with('Media')->get();

        $this->dispatchBrowserEvent('contentChanged');
        //dd($images)->array();
        return view('livewire.mediaKeyword-table',['images'=>$images]);

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
