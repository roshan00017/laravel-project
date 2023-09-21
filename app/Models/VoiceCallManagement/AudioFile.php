<?php

namespace App\Models\VoiceCallManagement;

use Illuminate\Database\Eloquent\Model;

class AudioFile extends Model
{
    protected $table = 'audio_files';

    protected $fillable = [
        'fy_id',
        'client_id',
        'module_name',
        'module_unique_id',
        'audio_file',
        'audio_size',
        'created_by',
        'deleted_by',
        'generate_date_np',
        'generate_date_en',
        'fy_id',
    ];
}
