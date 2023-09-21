<?php

namespace App\Models\Dcc;

use App\Models\BasicDetails\MstDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRelatedDocument extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'document_detail_en',
        'document_detail_np',
        'service_id',
        'service_type_id',
        'department_id',
        'service_rate',
        'service_time',
        'service_id',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(MstDepartment::class, 'department_id');
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceBodyType::class, 'service_type_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
