<?php

namespace App\Models\SystemSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'app_name',
            'app_name_np',
            'app_short_name',
            'app_short_name_np',
            'app_logo',
            'login_attempt_required',
            'login_attempt_limit',
            'login_title',
            'login_title_np',
            'login_captcha_required',
            'login_ip_address_required',
            'login_ip_address',
            'forget_password_required',
            'api_key_expire_time',
        ];
}
