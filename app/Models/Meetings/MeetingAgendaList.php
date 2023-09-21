<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingAgendaList extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'code',
            'meeting_id',
            'title',
            'description',
            'status',
            'client_id',
            'created_by',
            'updated_by',
            'deleted_by',
        ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
