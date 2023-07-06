<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_chapter';

    protected $fillable = [
        'bp_chapter_id',
        'bp_chapter_name',
        'bp_chapter_sequence',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_chapter_id';

    public function Section()
    {
        return $this->hasMany(Section::class,'bp_chapter_id','bp_chapter_id');
    }

    public function Tag()
    {
        return $this->hasManyThrough(Tag::class, Section::class, 'bp_chapter_id','bp_tag_id','bp_chapter_id','bp_tag_id');
    }

    //Chapter->Section->Content_hashtag
    public function Content_hashtag()
    {
        return $this->hasManyThrough(Content_hashtag::class, Section::class,'bp_chapter_id','bp_tag_id','bp_chapter_id','bp_tag_id');
    }

}
