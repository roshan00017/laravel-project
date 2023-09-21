<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class DcMedium extends Model
{
    protected $table = 'dc_medium';

    protected $fillable =
        [
            'code',
            'name_np',
            'name_en',
            'remarks',
        ];
}
