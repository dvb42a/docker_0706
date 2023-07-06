<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_hashtag_sys';

    protected $fillable = [
        'bp_tag_id',
        'bp_hashtag',
        'created_at',
        'updated_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_tag_id';

    //搜尋功能
    public function toSearchableArray()
    {
        return [
            'bp_hashtag' => $this->bp_hashtag,
        ];
    }

    //與[類別群組]關連
    public function CategoryGP()
    {
        return $this->belongsTo(Categorygp::class,'bp_categorygp_id');
    }

    public function Section()
    {
        return $this->hasMany(Section::class,'bp_tag_id','bp_tag_id');
    }

    public function Content_hashtag()
    {
        return $this->hasMany(Content_hashtag::class,'bp_tag_id','bp_tag_id');
    }

    public function Chapter()
    {
        return $this->hasMany(Chapter::class,'bp_tag_id','bp_tag_id');
    }
    //Tag->Content_hashtag->Content =>抓出軟刪除以外的資料
    public function Content()
    {
        return $this->hasManyThrough(Content::class, Content_hashtag::class, 'bp_tag_id','bp_subsection_id','bp_tag_id','bp_subsection_id')->where('bp_subsection_state','!=','4');
    }

    public function MediaTag()
    {
        return $this->hasMany(MediaTag::class,'bp_tag_id','bp_tag_id');
    }


}
