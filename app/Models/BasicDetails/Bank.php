<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'code',
            'name_np',
            'name_en',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
}
