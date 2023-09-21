<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'version_update_date_np',
            'version_update_date_en',
            'previous_version',
            'version_number',
            'version_module',
            'version_prefix',
            'latest_version',
        ];
}
