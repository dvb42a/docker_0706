<?php

namespace App\Http\Livewire\center;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin;
use App\Models\Role;
use DB;


class adminstable extends Component
{
    use WithPagination;

    //public $sections;
    public $searchMediacategory='';
    public $trash;
    public $paginationNum=6;
    public $sortByColumnName="admins.created_at";
    public $sortDirection='desc';

    public $byRank;
    public $byPlatform='';
    public $byRole='';
    public $role;
    public $byStatus='';
    public $searchInput='';

    public function render()
    {


/*         if($this->role == null)
        {
            $admins=Admin::select('roles.c_name','admins.id','admins.name','admins.account','admins.email','admins.status')
            ->where('admins.status','like','%'.$this->byStatus.'%')
            ->where('roles.name','like','%'.$this->role.'%')
            ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
            ->join('roles','model_has_roles.role_id','=','roles.id')
            ->orderBy($this->sortByColumnName,$this->sortDirection)
            ->where('admins.email','like','%'.$this->searchInput.'%')
            ->orwhere('admins.name','like','%'.$this->searchInput.'%')
            ->orwhere('admins.account','like','%'.$this->searchInput.'%')
            ->get();
        }
        else
        {
            $admins=Role::where('roles.name','like','%'.$this->role.'%')
            ->where('admins.status','like','%'.$this->byStatus.'%')
            ->select('roles.c_name','admins.id','admins.name','admins.account','admins.email','admins.status')
            ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
            ->join('admins','admins.id','=','model_has_roles.model_id')
            ->orwhere('admins.email','like','%'.$this->searchInput.'%')
            ->orwhere('admins.name','like','%'.$this->searchInput.'%')
            ->orwhere('admins.account','like','%'.$this->searchInput.'%')
            ->get();
        } */

        $admins=Role::where('roles.name','like','%'.$this->role.'%')
        ->when($this->searchInput ,function ($query, $searchInput){
            $query->where('admins.account','like','%'.$searchInput.'%');
            $query->orwhere('admins.name','like','%'.$searchInput.'%');
            $query->orwhere('admins.email','like','%'.$searchInput.'%');
        })
        ->when($this->byStatus,function ($query,$byStatus){
            $query->where('admins.status',$byStatus);
        })
        ->select('roles.c_name','admins.id','admins.name','admins.account','admins.email','admins.status')
        ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
        ->join('admins','admins.id','=','model_has_roles.model_id')
        ->orderBy($this->sortByColumnName,$this->sortDirection)
        ->get();
        //dd($admins);
        $roles=Role::all();

        return view('livewire.center.admins-table',['admins'=>$admins ,'roles'=>$roles]);
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

    public function byRank($value)
    {
        $this->role=$value;
    }

    public function byPlatform($value)
    {
        $this->role=$value;
    }

    public function byRole($value)
    {
        $this->role=$value;
    }

    public function reset_button()
    {
        $this->sortByColumnName="admins.created_at";
        $this->sortDirection='asc';
        $this->role="";
        $this->byStatus="";
    }
}
