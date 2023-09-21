<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable =
    [
        'code',
        'name_en',
        'name_np',
        'status',
    ];
}
