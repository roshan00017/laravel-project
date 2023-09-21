<?php

namespace App\Models\BasicDetails;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MstSetting extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'label_np',
            'label_en',
            'value',
            'client_id',
        ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
