<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryGP extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_category_gp';

    protected $fillable = [
        'bp_categorygp_id',
        'bp_category_id',
        'bp_tag_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_categorygp_id';

    //與類別關連
    public function Category()
    {
        return $this->belongsTo(Category::class,'bp_category_id');
    }

    //與關鍵字關連
    public function Tag()
    {
        return $this->hasMany(Tag::class, 'bp_tag_id','bp_tag_id');
    }
}
