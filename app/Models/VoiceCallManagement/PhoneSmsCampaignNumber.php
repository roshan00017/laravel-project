<?php

namespace App\Models\VoiceCallManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneSmsCampaignNumber extends Model
{
    use SoftDeletes;

    protected $table = 'phone_sms_campaign_numbers';

    protected $fillable = [
        'fy_id',
        'client_id',
        'campaign_id',
        'campaign_api_id',
        'api_number_id',
        'number',
        'status',
        'duration',
        'playback',
        'credit_consumed',
        'available_tags',
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
}
