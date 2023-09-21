<?php

namespace App\Models\SystemSetting;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtpSetting extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'otp_limit',
            'client_id',
            'otp_duration',
            'created_by',
            'updated_by',
            'deleted_by',
            'status',
        ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
