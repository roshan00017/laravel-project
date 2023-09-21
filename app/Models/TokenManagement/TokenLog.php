<?php

namespace App\Models\TokenManagement;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokenLog extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'client_id',
            'module_name',
            'module_status_id',
            'token_no',
            'status_title_np',
            'status_title_en',
            'module_unique_id',
            'date_np',
            'date_en',
            'fy_id',
        ];

    protected $dates = ['deleted_at'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
