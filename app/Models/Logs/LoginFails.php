<?php

namespace App\Models\Logs;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginFails extends Model
{
    protected $fillable =
        [
            'user_name',
            'client_id',
            'fail_password',
            'log_fails_date',
            'log_fails_date_np',
            'log_in_ip',
            'log_in_device',
            'login_fail_count',
            'user_id',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
