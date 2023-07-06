<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Media;
use App\Models\Beauty\MediaCategory;
class mediatable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchMedia='';
    public $paginationNum=15;

    public function render()
    {
        $mediaFile=MediaCategory::where('kmc_name','文章圖片')->first();
        $searchMedia='%'.$this->searchMedia.'%';
        $medias =Media::where('kmc_id',$mediaFile->kmc_id)
        ->whereIn('km_state',[1])
        ->where('km_name','like','%'.$this->searchMedia.'%')
        ->orderBy('created_at','desc')
        ->paginate($this->paginationNum);
        return view('livewire.media-table',['medias'=>$medias]);
    }

    public function paginationView()
    {
        return 'livewire.custom_pagination';
    }

    public function updatedsearchMedia()
    {
        $this->resetpage();
    }

    public function refreshPage()
    {
       $this->updatedsearchMedia();
    }

}
