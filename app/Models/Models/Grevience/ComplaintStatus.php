<?php

namespace App\Models\Models\Grevience;

use Illuminate\Database\Eloquent\Model;

class ComplaintStatus extends Model
{
    protected $table = 'complaint_statuses';

    protected $fillable = [
        'code',
        'name',
        'name_ne',
        'status',
        'depth',
    ];
}
