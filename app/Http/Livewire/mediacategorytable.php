<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaCategory;
class mediacategorytable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchMediacategory='';
    public $trash;
    public $paginationNum=6;
    public $sortByColumnName="kmc_name";
    public $sortDirection='asc';

    public function render()
    {
        $imgcategorys=MediaCategory::withCount('Media')
            ->where('kmc_name','like','%'.$this->searchMediacategory.'%')
            ->whereNotIn('kmc_name',['自動轉動百科廣告'])
            ->orderBy($this->sortByColumnName , $this->sortDirection)
            ->paginate($this->paginationNum);
        $this->trash=Media::where('km_state',0)->count();
        return view('livewire.mediacategory-table',['imgcategorys'=>$imgcategorys]);
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

    public function updatedsearchMediacategory()
    {
        $this->resetpage();
    }

}
