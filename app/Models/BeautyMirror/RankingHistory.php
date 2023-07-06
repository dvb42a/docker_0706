<?php

namespace App\Models\BeautyMirror;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Beauty\Tag;


class RankingHistory extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bm_ranking_totalhistory';

    protected $fillable = [
        'bmrth_id',
        'bmrth_min',
        'bmrth_mid',
        'bmrth_max',
        'bmrth_count',
        'updated_at',

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
