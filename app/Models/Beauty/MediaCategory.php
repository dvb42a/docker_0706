<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MediaCategory extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'k_media_category';

    protected $fillable = [
        'kmc_id',
        'kmc_name',
        'kmc_position',
        'kmc_width',
        'kmc_height',
        'kmc_resize',
        'kmc_resize_width',
        'kmc_resize_height',

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'kmc_id';

    //搜尋功能
    public function toSearchableArray()
    {
        return [
            'kmc_name' => $this->kmc_name,
            'kmc_position'=>$this->kmc_position,
            'kmc_width'=>$this->kmc_width,
            'kmc_height'=>$this->kmc_height,
            'kmc_resize_width'=>$this->kmc_resize_width,
            'kmc_resize_height'=>$this->kmc_resize_height
        ];
    }

    public $states=[1,2];
    public function Media()
    {
        return $this->hasMany(Media::class,'kmc_id','kmc_id')->where('km_state', $this->states);
    }

    public function MediaCheckDeleteHasMedia()
    {
        return $this->hasMany(Media::class,'kmc_id','kmc_id')->where('km_state', '0');
    }

    public function MediaWithCanUse()
    {
        return $this->hasMany(Media::class , 'kmc_id','kmc_id')->where('km_state','1');
    }

}
