<?php

namespace App\Models\ApiSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiAccess extends Model
{
    protected $table = 'api_key_access_events';

    public function apiName(): BelongsTo
    {
        return $this->belongsTo(ApiKey::class, 'api_key_id');
    }
}
