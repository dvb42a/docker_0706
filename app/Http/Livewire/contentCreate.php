<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Content;
use App\Models\Beauty\Content_index;
use Auth ;

class contentCreate extends Component
{
    public $bp_subsection_title='';

    protected $rules=[
        'bp_subsection_title' =>['required','string','max:40','unique:bp_subsection'],
    ];

    public function render()
    {
        return view('livewire.content-create');
    }

    public function updated($propertybp_subsection_title)
    {
        $this->validateOnly($propertybp_subsection_title);
    }

    public function submit()
    {
        $this->validate();

        $content= new Content;
        $content->bp_subsection_title= $this->bp_subsection_title;
        $content->k_id =Auth::guard('admin')->user()->id;
        $content->created_at=date('Y-m-d H:i:s');
        $content->updated_at=date('Y-m-d H:i:s');
        $content->bp_subsection_state=0;
        $content->save();
        $content_id=$content->bp_subsection_id;

        $content_cnt=new Content_index;
        $content_cnt->bp_subsection_id=$content->bp_subsection_id;
        $content_cnt->created_at=date('Y-m-d H:i:s');
        $content_cnt->save();

        $content_id=$content->bp_subsection_id;
        return redirect()->route('content.edit',$content_id);
    }
}
