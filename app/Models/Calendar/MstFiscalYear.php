<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;

class MstFiscalYear extends Model
{
    protected $table = 'mst_fiscal_year';

    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'code',
        'date_from_bs',
        'date_from_ad',
        'date_to_bs',
        'date_to_ad',
        'description',
        'status',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_by',
        'deleted_on',
        'is_deleted',
        'deleted_un_code',
        'client_ward',
    ];
}
