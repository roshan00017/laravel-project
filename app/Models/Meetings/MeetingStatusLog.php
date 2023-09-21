<?php

namespace App\Models\Meetings;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingStatusLog extends Model
{
    protected $fillable =
        [
            'meeting_id',
            'meeting_status_id',
            'remarks',
            'updated_date_en',
            'updated_date_np',
            'updated_by',

        ];

    public function meetingStatus(): BelongsTo
    {
        return $this->belongsTo(MstMeetingStatus::class, 'meeting_status_id', 'id');
    }

    public function updateBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
