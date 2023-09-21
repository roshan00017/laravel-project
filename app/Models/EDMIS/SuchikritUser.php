<?php

namespace App\Models\EDMIS;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuchikritUser extends Authenticatable
{
    use Notifiable;

    protected $dates = ['deleted_at'];

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'suchikrit_users';

    protected $fillable =
        [
            'client_id',
            'full_name_np',
            'full_name_en',
            'email',
            'mobile_no',
            'user_name',
            'register_date_bs',
            'register_date_ad',
            'password',
            'status',
            'password_status',
            'otp_code',
            'otp_count',
            'otp_created_date_ad',
            'otp_created_date_bs',
            'otp_token',
        ];
}
