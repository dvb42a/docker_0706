<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MediaTag extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'k_media_tag';

    protected $fillable = [
        'kmt_id',
        'km_id',
        'bp_tag_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'kmt_id';

    //搜尋功能
    public function toSearchableArray()
    {
        return [
            //
        ];
    }

    public function Media()
    {
        return $this->hasOne(Media::class,'km_id','km_id');
    }

    public function Tag()
    {
        return $this->hasMany(Tag::class, 'bp_tag_id','bp_tag_id');
    }

    public function MediaCategory()
    {
        return $this->hasOneThrough(MediaCategory::class, Media::class,'km_id','kmc_id','km_id','km_id');
    }


}
