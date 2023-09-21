<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientSetting extends Model
{
    protected $table = 'client_setting';

    protected $fillable =
     [
         'client_id',
         'setting_code',
         'value',
         'status',
     ];

    public function master_setting(): BelongsTo
    {
        return $this->belongsTo(MasterSetting::class, 'setting_code', 'code');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
