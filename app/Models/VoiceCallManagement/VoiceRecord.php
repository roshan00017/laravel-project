<?php

namespace App\Models\VoiceCallManagement;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoiceRecord extends Model
{
    protected $table = 'voice_records';

    protected $fillable =
        [
            'client_id',
            'module_name',
            'module_unique_id',
            'audio_file',
            'audio_size',
            'created_by',
            'deleted_by',
            'generate_date_np',
            'generate_date_en',
        ];

    protected $dates = ['deleted_at'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
