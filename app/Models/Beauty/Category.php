<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_category_sys';

    protected $fillable = [
        'bp_category_id',
        'bp_category',
        'created_at',
        'updated_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bp_category_id';

    //搜尋功能
    public function toSearchableArray()
    {
        return [
            'bp_category' => $this->bp_category,
        ];
    }

    //與[類別群組]關連
    public function CategoryGP()
    {
        return $this->hasMany(CategoryGP::class, 'bp_category_id');
    }

    public function Tag()
    {
        return $this->hasManyThrough(Tag::class,CategoryGP::class, 'bp_category_id' , 'bp_tag_id','bp_category_id','bp_tag_id');
    }

}
