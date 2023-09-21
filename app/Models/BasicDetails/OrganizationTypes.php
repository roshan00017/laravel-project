<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationTypes extends Model
{
    use SoftDeletes;

    protected $table = 'organization_types';

    protected $fillable =
        [

            'name_np',
            'name_en',
            'details',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
}
