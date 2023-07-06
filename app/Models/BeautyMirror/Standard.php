<?php

namespace App\Models\BeautyMirror;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Beauty\Tag;


class Standard extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bm_standard';

    protected $fillable = [
        'bms_id',
        'bms_cname',
        'bp_tag_id',
        'bms_cnt',
        'bms_lv',
        'bms_lower',
        'bms_upper',
        'bms_type'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bms_id';

    public function Tag()
    {
        return $this->HasOne(Tag::class,'bp_tag_id','bp_tag_id');
    }

    public function Type()
    {
        return $this->HasOne(Tag::class,'bp_tag_id','bms_type');
    }

}
