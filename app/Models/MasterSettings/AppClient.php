<?php

namespace App\Models\MasterSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppClient extends Model
{
    public $timestamps = false;

    protected $table = 'app_client';

    protected $fillable =
        [
            'code',
            'name_en',
            'name_np',
            'province_id',
            'district_id',
            'status',
            'description',
            'web_url',
            'api_web_url',
            'province_code',
            'local_body_mapping_id',
        ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');

    }

    public function district(): belongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'code');

    }

    public function localBody(): belongsTo
    {
        return $this->belongsTo(LocalBody::class, 'local_body_mapping_id', 'code');

    }
}
