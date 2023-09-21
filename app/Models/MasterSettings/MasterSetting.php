<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;

class MasterSetting extends Model
{
    protected $table = 'master_setting';

    protected $fillable =
    [
        'code',
        'name_np',
        'name_en',
        'status',
    ];
}
