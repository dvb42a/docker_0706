<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'name',
        'c_name',
        'guard_name',
        'created_at',
        'updated_dt'

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function admins()
    {
        return $this->hasManyThrough(Admin::class,ModelRole::class,'role_id','id','id','model_id');
    }
    public function modelrole()
    {
        return $this->hasMany(ModelRole::class,'role_id','id');
    }


}
