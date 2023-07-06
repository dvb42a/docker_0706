<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content_hashtag extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_subsection_hashtag';

    protected $fillable = [
        'bp_sh_id',
        'bp_subsection_id',
        'bp_tag_id',
        'bp_display_top',
        'bp_type_keep',
        'bp_type_fix',
        'bp_type_info',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_sh_id';

    public function hashtag()
    {
        return $this->hasOne(Tag::class,'bp_tag_id','bp_tag_id');
    }

    public function Section()
    {
        return $this->hasMany(Section::class,'bp_tag_id','bp_tag_id');
    }

    public function Content()
    {
        return $this->BelongsTo(Content::class,'bp_subsection_id','bp_subsection_id');
    }

    public function Content_normal()
    {
        return $this->hasMany(Content::class,'bp_subsection_id','bp_subsection_id');
    }

    public function Media()
    {
        return $this->hasOneThrough(Media::class, Content::class,'bp_subsection_id','km_id','bp_subsection_id','km_id');
    }

    public function ApiContent()
    {
        return $this->BelongsTo(Content::class,'bp_subsection_id','bp_subsection_id')
        ->select(['bp_subsection_id',
                'bp_subsection_title',
                'bp_subsection_intro',
                'bp_subsection_enabled_date'
        ])
        ->where('bp_subsection_state',2);;

    }

    public function ApiMedia()
    {
        return $this->hasOneThrough(Media::class, Content::class,'bp_subsection_id','km_id','bp_subsection_id','km_id')
        ->select('km_name');

    }
}
