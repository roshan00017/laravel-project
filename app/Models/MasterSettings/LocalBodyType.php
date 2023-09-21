<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalBodyType extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'name_np',
        'name_en',
        'status',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
