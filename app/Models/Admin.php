<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class Admin extends Model implements Authenticatable
{
    use HasRoles;

    protected $guard = 'admin';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'created_at'

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // ... class implementation ...

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the remember token for the user.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the remember token for the user.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function log()
    {
        return $this->hasMany(LogAdmin::class,'id','id');
    }



    public function RoleGroup()
    {
        return $this->belongsTo(ModelRole::class,'id','model_id');
    }

    public function getRoleCName()
    {
        return $this->RoleGroup->role->c_name;
    }


}
