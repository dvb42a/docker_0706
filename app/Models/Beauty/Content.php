<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_subsection';

    protected $fillable = [
        'bp_subsection_id',
        'bp_subsection_title',
        'bp_subsection_intro',
        'bp_subsectioncnt_id',
        'bp_subsection_enabled_date',
        'bp_subsection_enabled_time',
        'bp_subsection_member_only',
        'bp_subsection_state',
        'km_id',
        'k_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_subsection_id';

    public function Content_index()
    {
        return $this->hasOne(Content_index::class,'bp_subsection_id','bp_subsection_id');
    }

    public function Content_hashtag()
    {
        return $this->hasOne(Content_hashtag::class,'bp_subsection_id','bp_subsection_id');
    }

    public function Media()
    {
        return $this->hasOne(Media::class,'km_id');
    }

    public function hashtag()
    {
        return $this->hasManyThrough(Tag::class, Content_hashtag::class, 'bp_subsection_id','bp_tag_id','bp_subsection_id','bp_tag_id');
    }

    public function ApiMedia()
    {
        return $this->hasOne(Media::class,'km_id','km_id')->select('km_id','km_name');
    }

    public function ApiContentIndex()
    {
        return $this->hasOne(Content_index::class,'bp_subsection_id','bp_subsection_id')->select('bp_subsection_id','bp_subsectioncnt_index');
    }
    //下方為文章全內容指令
    //$sections= Content::with('hashtag','content_index')->get();
}
