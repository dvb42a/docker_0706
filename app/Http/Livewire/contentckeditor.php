<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_index;
use Auth ;

class contentckeditor extends Component
{
    public $content_id;
    public $bp_subsection_cnt="";
    public function render()
    {
        $content_index=Content_index::where('bp_subsection_id',$this->content_id)->first();
        //dd($content_index);
        return view('livewire.content-ckeditor' ,['content_index'=>$content_index]);
    }

    public function updatedbp_subsection_cnt()
    {
        dd($this->bp_subsection_cnt);
    }

}
