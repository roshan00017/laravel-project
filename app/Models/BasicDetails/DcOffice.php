<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class DcOffice extends Model
{
    public $timestamps = false;

    protected $table = 'dc_office';

    protected $fillable =
        [
            'code',
            'name_np',
            'name_en',
            'status',
            'remarks',
            'address',
            'contact_person',
            'contact_no',
            'client_id',
        ];
}
