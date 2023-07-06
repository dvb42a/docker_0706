<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Beauty\Tag;
use App\Models\Beauty\Section;
use App\Models\Beauty\Content;
use App\Models\Beauty\Chapter;
class TestTable extends Component
{
    //public $sections;

    public function render()
    {
        $chapter=1;
        $sections=Section::where('bp_chapter_id',1)->with('Tag')->orderBy('bp_section_sequence','asc')->get();
        $chapter2=2;
        $sections_2=Section::where('bp_chapter_id',2)->with('Tag')->orderBy('bp_section_sequence','asc')->get();

        return view('livewire.test-table',compact('sections','chapter','chapter2','sections_2'));
    }
    public function updateTaskOrder($sections){
       //dd($sections);
        foreach($sections as $section){
        Section::find($section['value'])->update(['bp_section_sequence'=> $section['order']]);
       }
    }
    public function deleteKy($delelteKy, Section $sections)
    {
        $chapterHashtag = Section::where('bp_section_id',$delelteKy)->first();
        $position_change = $sections->where('bp_chapter_id',$chapterHashtag->bp_chapter_id)
        ->where('bp_section_sequence','>',$chapterHashtag->bp_section_sequence)
        ->update(['bp_section_sequence'=>\DB::raw('bp_section_sequence-1')] );
        $chapterHashtag->delete();
    }
/*     public function section_up($section_id)
    {
        dd($section_id);
    } */
}
