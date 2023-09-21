<?php

namespace App\Models\Dcc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceDepartment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name_np',
        'name_en',
        'code',
        'client_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
