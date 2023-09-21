<?php

namespace App\Models\Grevience;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'fy_id',
        'client_id',
        'notify_date_np',
        'notify_date_en',
        'title_en',
        'title_np',
        'notify_url',
        'notify_id',
        'notify_read_by',
        'notify_read_by',
        'notify_type',
        'notification_read_date_en',
        'notification_read_date_np',
        'notify_to_user_id',
    ];

    protected $table = 'notifications';

    public function readBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'notify_read_by');
    }
}
