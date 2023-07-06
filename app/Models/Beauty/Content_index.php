<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content_index extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_subsection_cnt';

    protected $fillable = [
        'bp_subsectioncnt_id',
        'bp_subsection_id',
        'bp_subsectioncnt_index',
        'created_at',
        'updated_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_subsectioncnt_id';

    public function Content()
    {
        return $this->belongsTo(Content::class,'bp_subsection_id');
    }
}
