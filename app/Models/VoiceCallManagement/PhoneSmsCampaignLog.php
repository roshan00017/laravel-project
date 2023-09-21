<?php

namespace App\Models\VoiceCallManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneSmsCampaignLog extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'phone_sms_campaign_logs';

    protected $fillable = [
        'campaign_id',
        'campaign_api_id',
        'action_name',
        'action_date_np',
        'action_date_en',
        'action_by',
    ];
}
