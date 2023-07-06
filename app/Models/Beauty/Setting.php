<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_setting_sys';

    protected $fillable = [
        'bps_id',
        'bps_bannerswitch'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bps_id';


}
