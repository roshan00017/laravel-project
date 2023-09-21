<?php

namespace App\Models\VoiceCallManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneSmsCampaignMessage extends Model
{
    use SoftDeletes;

    protected $table = 'phone_sms_campaign_messages';

    protected $fillable = [
        'fy_id',
        'client_id',
        'campaign_id',
        'campaign_api_id',
        'service_type',
        'voice_input',
        'message',
        'is_schedule',
        'schedule_date_np',
        'schedule_date_en',
        'audio_file',
        'available_tags',
        'action_by',
        'action_date_en',
        'action_date_np',
    ];
}
