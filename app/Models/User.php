<?php

namespace App\Models;

use App\Models\BasicDetails\ElectedPerson;
use App\Models\EDMIS\Employee;
use App\Models\MasterSettings\AppClient;
use App\Models\Roles\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['deleted_at'];

    const USER_PROFILE_PATH = 'uploads/users/profiles';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'role_id',
            'client_id',
            'full_name',
            'user_module',
            'full_name_np',
            'login_user_name',
            'email',
            'password',
            'image',
            'status',
            'address',
            'mobile_no',
            'block_status',
            'password_reset_token',
            'password_reset_created_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'branch_id',
            'ward_no',
            'employee_id',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'appointment_access_user_id');
    }
    public function electedPerson(): BelongsTo
    {
        return $this->belongsTo(ElectedPerson::class, 'appointment_access_user_id');
    }
}