<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class MstOffice extends Model
{
    public $timestamps = false;

    protected $table = 'mst_offices';

    protected $fillable =
        [
            'code',
            'name',
            'name_ne',
            'status',
            'address',
            'contact_no',
            'contact_person',
            'created_at',
            'updated_at'
        ];
}
