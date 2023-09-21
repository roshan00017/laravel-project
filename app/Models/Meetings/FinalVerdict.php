<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalVerdict extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'code',
            'meeting_id',
            'client_id',
            'member_id',
            'feedback',
            'agenda_id',
            'created_by',
            'updated_by',
            'deleted_by',
        ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function meeting_member(): BelongsTo
    {
        return $this->belongsTo(MeetingMember::class, 'member_id');
    }

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(MeetingAgendaList::class, 'agenda_id');
    }
}
