<?php

namespace App\Models\Meetings;

use App\Models\MasterSettings\AppClient;
use App\Models\TokenManagement\Token;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    protected $fillable =
        [

            'fy_id',
            'client_id',
            'code',
            'meeting_category_id',
            'proposed_date_ad',
            'proposed_date_bs',
            'proposed_time',
            'agenda_finalized',
            'meeting_status_id',
            'meeting_date_ad',
            'meeting_date_bs',
            'room_no',
            'meeting_time',
            'title',
            'description',
            'meeting_url',
            'meeting_mode',
            'agenda_finalized_date_bs',
            'agenda_finalized_date_ad',
            'notify_date_bs',
            'notify_date_ad',
            'is_notify',
            'meeting_venue',
            'meeting_month_code',
            'is_public',
            'meeting_password_available',
            'meeting_password',
            'meeting_iframe',
            'campaign_id',
            'is_campaign_create',

        ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MstMeetingCategory::class, 'meeting_category_id', 'code');
    }

    public function meetingAgendaList(): BelongsTo
    {
        return $this->belongsTo(MeetingAgendaList::class, 'id', 'agenda_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }

    public function token(): hasOne
    {
        return $this->hasOne(Token::class, 'module_unique_id');
    }

    public function meeting_member(): BelongsTo
    {
        return $this->belongsTo(MeetingMember::class, 'member_id');
    }
}
