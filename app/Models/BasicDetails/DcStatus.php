<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class DcStatus extends Model
{
    protected $table = 'dc_status';

    protected $fillable =
        [
            'code',
            'name_en',
            'name_np',
            'status',
        ];
}
