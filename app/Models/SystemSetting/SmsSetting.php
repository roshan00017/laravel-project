<?php

namespace App\Models\SystemSetting;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsSetting extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'sms_token',
            'client_id',
            'sms_url',
            'sms_from',
            'created_by',
            'updated_by',
            'deleted_by',
            'status',
            'sms_provider_name',
            'type',
            'dlr',
        ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
