<?php

namespace App\Models\VoiceCallManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneSmsCampaign extends Model
{
    use SoftDeletes;

    protected $table = 'phone_sms_campaigns';

    protected $fillable = [
        'fy_id',
        'client_id',
        'module_name',
        'module_unique_id',
        'campaign_name',
        'campaign_detail',
        'campaign_number_count',
        'campaign_service',
        'campaign_status',
        'campaign_api_id',
        'campaign_added_date_np',
        'campaign_added_date_en',
        'campaign_run_by',
        'campaign_run_date_np',
        'campaign_run_date_en',
        'campaign_re_run_by',
        'campaign_re_run_date_np',
        'campaign_re_run_date_en',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
