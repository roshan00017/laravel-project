<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fy_id',
        'client_id',
        'title',
        'tag',
        'description',
        'file',
        'type',
        'added_date_bs',
        'added_date_ad',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $table = 'notices';
}
