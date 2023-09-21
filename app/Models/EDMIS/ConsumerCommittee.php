<?php

namespace App\Models\EDMIS;

use App\Models\MasterSettings\District;
use App\Models\MasterSettings\LocalBody;
use App\Models\MasterSettings\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumerCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'form_date_bs',
        'form_date_ad',
        'status',
        'ward_no',
        'bank',
        'bank_acc_num',
        'bank_address',
        'present_number',
        'members_number',
        'witness_name',
        'full_name',
        'name',
        'consumer_committee_type',
        'regd_no',
        'regd_date_bs',
        'regd_date_ad',
        'office',
        'other_details',
        'per_province_code',
        'per_district_code',
        'per_local_body_code',
        'per_ward_no',
        'per_street_name',
        'temp_province_code',
        'temp_district_code',
        'temp_local_body_code',
        'temp_ward_no',
        'temp_street_name',
        'phone',
        'mobile',
        'fax',
        'email',
        'post_address',
        'contact_person_full_name',
        'contact_person_name',
        'contact_person_designation',
        'contact_person_phone',
        'contact_person_mobile',
        'remarks',

    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'per_province_code', 'code');

    }

    public function district(): belongsTo
    {
        return $this->belongsTo(District::class, 'per_district_code', 'code');

    }

    public function localBody(): belongsTo
    {
        return $this->belongsTo(LocalBody::class, 'per_local_body_code', 'code');

    }

    public function tempProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'temp_province_code', 'code');

    }

    public function tempDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'temp_district_code', 'code');

    }

    public function tempLocalBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class, 'temp_local_body_code', 'code');

    }
}
