<?php

namespace App\Models\BeautyMirror;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class NormalInspection extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bm_normal_inspection';

    protected $fillable = [
        'bmni_id',
        'k_id',
        'bmnit_head',
        'bmni_eyebrow',
        'bmni_fishtail_b',
        'bmni_fishtail_c',
        'bmni_tears_b',
        'bmni_tears_c',
        'bmni_nasolabial_d',
        'bmni_nasolabial_e',
        'bmni_mouth',
        'bmni_skin_a',
        'bmni_skin_b',
        'bmni_skin_e',
        'bmni_skin_f',
        'bmni_pigmentation_a',
        'bmni_pigmentation_b',
        'bmni_pandaeye_b',
        'bmni_pandaeye_c',
        'bmni_acne_a',
        'bmni_acne_b',
        'bmni_acne_c',
        'bmni_acne_d',
        'bmni_waterOil_d',
        'bmni_waterOil_e',
        'bmni_result_rating',
        'bmni_result_ranking',
        'updated_at',
        'created_at',

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bmni_id';


}
