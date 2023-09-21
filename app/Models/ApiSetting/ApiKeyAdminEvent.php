<?php

namespace App\Models\ApiSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiKeyAdminEvent extends Model
{
    protected $table = 'api_key_admin_events';

    /**
     * Get the related ApiKey record
     */
    public function apiKey(): BelongsTo
    {
        return $this->belongsTo(ApiKey::class, 'api_key_id');
    }
}
