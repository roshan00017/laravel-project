<?php

namespace App\Models\Roles;

use App\Models\MasterSettings\AppClient;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'client_id',
            'name_en',
            'name_np',
            'details',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
            'role_module',
        ];

    protected $dates = ['deleted_at'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
