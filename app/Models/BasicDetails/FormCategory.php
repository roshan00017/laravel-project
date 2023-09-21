<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class FormCategory extends Model
{
    protected $fillable =
        [
            'code',
            'name',
            'name_ne',
            'status',
        ];
}
