<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'k_media_sys';

    protected $fillable = [
        'km_id',
        'km_cname',
        'km_name',
        'kmc_id',
        'km_cnt',
        'km_state',
        'km_size',
        'km_mediawidth',
        'km_mediaheight',
        'created_at',
        'updated_at',

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'km_id';

    //搜尋功能
    public function toSearchableArray()
    {
        return [
            //
        ];
    }

    public function MediaCategory()
    {
        return $this->hasOne(MediaCategory::class,'kmc_id','kmc_id');
    }

    public function Content()
    {
        return $this->belongsTo(Content::class,'km_id');
    }

    public function MediaWithTag()
    {
        return $this->hasManyThrough(Tag::class , MediaTag::class , 'km_id' ,'bp_tag_id', 'km_id','bp_tag_id');
    }



}
