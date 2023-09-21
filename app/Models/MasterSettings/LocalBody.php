<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;

class LocalBody extends Model
{
    protected $fillable =
    [
        'province_code',
        'district_code',
        'local_body_type_id',
        'name_np',
        'name_en',
        'code',
        'status',
        'web_url',
        'total_ward',
        'area',
        'area',
        'population',
        'lat',
        'lan',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
