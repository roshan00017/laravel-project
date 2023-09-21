<?php

namespace App\Models\Logs;

use App\Models\Roles\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionLogs extends Model
{
    protected $fillable =
        [
            'action_user_id',
            'client_id',
            'action_date',
            'action_date_np',
            'action_device',
            'action_ip',
            'action_module',
            'action_name',
            'action_id',
            'action_url',
        ];

    public function menuName(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'action_module');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'action_user_id');
    }

    /**
     * @return string[]
     */
    public function getFillAble(): array
    {
        return $this->fillable;
    }
}
