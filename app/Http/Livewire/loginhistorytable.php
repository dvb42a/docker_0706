<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Log\LogAdmin;
use Auth;

class loginhistorytable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchMedia='';
    public $paginationNum=12;

    public function render()
    {
        $logs=LogAdmin::where('id',Auth::guard('admin')->user()->id)
        ->orderBy('login_at','desc')
        ->paginate($this->paginationNum);

        return view('livewire.loginhistory-table',['logs'=>$logs]);
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
