<?php

namespace App\Models\SystemSetting;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailSetting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'mail_driver',
            'client_id',
            'mail_host_name',
            'mail_port',
            'mail_user_name',
            'mail_password',
            'mail_encryption',
            'mail_from_address',
            'status',
            'created_by',
        ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
