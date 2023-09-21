<?php

namespace App\Models\VoiceCallManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneSmsCampaignNumberLog extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'phone_sms_campaign_number_logs';

    protected $fillable = [
        'number_id',
        'number_api_id',
        'date_np',
        'date_en',
        'status',
        'date_np',
        'action_by',
    ];
}
