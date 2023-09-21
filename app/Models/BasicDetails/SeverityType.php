<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class SeverityType extends Model
{
    protected $fillable =
        [
            'code',
            'name',
            'name_ne',
            'status',
            'depth',
        ];
}
