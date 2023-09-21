<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinalVerdictFile extends Model
{
    const FINAL_VERDICT_FILE_PATH = 'uploads/finalVerdicts/files';

    protected $fillable =
        [
            'client_id',
            'meeting_id',
            'files',
            'uploaded_date_np',
            'uploaded_date_en',
            'remarks',
            'uploaded_date_np',
            'uploaded_date_en',
            'uploaded_by',
        ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
