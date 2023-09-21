<?php

namespace App\Models\Grevience;

use Illuminate\Database\Eloquent\Model;

class IncidentReporting extends Model
{
    protected $table = 'incident_reportings';

    const FILE_UPLOAD_PATH = 'uploads/documents/incidents';

    protected $fillable =
        [
            'name',
            'mobile',
            'email',
            'email',
            'title',
            'description',
            'file',
            'latitude',
            'longitude',
            'address',
            'incident_submit_date_en',
            'incident_submit_date_np',
            'fy_id',
            'client_id',
            'incident_month_code',
        ];
}
