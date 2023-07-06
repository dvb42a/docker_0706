<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username',
        'password',
        'email',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'login_log',
        'last_login_at',
        'kmr_id',
        'kmt_id',
        'k_count_login',
        'km_realname',
        'km_phone',
        'km_addr',
        'km_job',
        'km_birth',
        'km_height',
        'km_weight',
        'km_blood_type',
        'km_marital_status',
        'km_from'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inspection()
    {
        return $this->hasOne(BeautyMirror\NormalInspection::class,'k_id','id');
    }


}
