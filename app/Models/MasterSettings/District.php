<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'province_code',
        'name_np',
        'name_en',
        'code',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
