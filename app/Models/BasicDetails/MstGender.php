<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class MstGender extends Model
{
    protected $table = 'mst_gender';

    protected $fillable =
        [
            'client_id',
            'code',
            'name_en',
            'name_np',
            'description',
            'status',
            'created_by',
            'created_on',
            'updated_by',
            'updated_on',
            'deleted_by',
            'deleted_on',
            'is_deleted',
            'deleted_uq_code',
            'display_order',
            'client_ward',
            'created_at',
        ];
}
