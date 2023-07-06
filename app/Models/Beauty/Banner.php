<?php

namespace App\Models\Beauty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Banner extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bp_banner_sys';

    protected $fillable = [
        'bpb_id',
        'km_id',
        'bpb_link',
        'bpb_first',
        'bpb_disabled'

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'bpb_id';

    public function media()
    {
        return $this->hasOne(Media::class,'km_id','km_id')->select('km_id', 'km_name','km_cname');
    }

}
