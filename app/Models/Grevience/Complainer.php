<?php

namespace App\Models\Grevience;

use Illuminate\Database\Eloquent\Model;

class Complainer extends Model
{
    protected $table = 'complainers';

    protected $fillable = [
        'client_id',
        'complaint_id',
        'name_en',
        'name_ne',
        'gender_id',
        'country_id',
        'province_id',
        'district_id',
        'local_government_id',
        'ward',
        'tole',
        'mobile_no',
        'email',
        'status',
    ];
}
