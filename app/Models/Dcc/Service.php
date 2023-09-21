<?php

namespace App\Models\Dcc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'service_type_id',
        'service_type_code',
        'name_np',
        'status',
        'name_en',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
