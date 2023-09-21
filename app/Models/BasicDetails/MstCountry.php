<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class MstCountry extends Model
{
    protected $table = 'mst_country';

    public $timestamps = false;

    protected $fillable =
        [
            'code',
            'name_np',
            'name_en',
            'description',
            'status',
            'created_by',
            'updated_on',
            'deleted_on',
            'is_deleted',
            'deleted_uq_code',
            'client_id',
            'client_ward',
            'created_at',
        ];
}
