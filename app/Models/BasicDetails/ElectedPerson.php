<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectedPerson extends Model
{
    use HasFactory;

    protected $table = 'elected_persons';

    protected $fillable =
        [
            'name_np',
            'name_en',
            'halko_bhu_pu',
            'tenure_start_date',
            'tenure_end_date',
            'email',
            'mobile',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
}
