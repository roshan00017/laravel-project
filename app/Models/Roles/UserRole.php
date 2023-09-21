<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'allow_add',
            'allow_delete',
            'allow_edit',
            'allow_index',
            'allow_show',
            'menu_id',
            'role_id',
        ];

    public function userRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
