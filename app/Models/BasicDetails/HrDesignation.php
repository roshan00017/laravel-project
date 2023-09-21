<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class HrDesignation extends Model
{
    protected $table = 'hr_designation';

    public $timestamps = false;

    protected $fillable =
    [
        'client_id',
        'code',
        'name_np',
        'name_en',
        'description',
        'emp_post',
        'status',
        'created_by',
        'updated_on',
        'deleted_on',
        'is_deleted',
        'deleted_uq_code',
    ];
}
