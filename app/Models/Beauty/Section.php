<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_section';

    protected $fillable = [
        'bp_section_id',
        'bp_chapter_id',
        'bp_tag_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_section_id';

    public function Tag()
    {
        return $this->belongsTo(Tag::class, 'bp_tag_id');
    }

    public function Content_hashtag()
    {
        return $this->belongsTo(Content_hashtag::class,'bp_tag_id','bp_tag_id');
    }

    public function Chapter()
    {
        return $this->belongsTo(Chapter::class,'bp_chapter_id','bp_chapter_id');
    }

}
