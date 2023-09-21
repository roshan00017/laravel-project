<?php

namespace App\Models\ApiSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiAccessSetting extends Model
{
    use SoftDeletes;

    protected $table = 'login_roles';

    protected $fillable =
        [
            'type',
            'base_url',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
}
