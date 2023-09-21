<?php

namespace App\Models\Grevience;

use App\Models\BasicDetails\ComplaintSource;
use App\Models\BasicDetails\FormCategory;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstGender;
use App\Models\BasicDetails\MstOffice;
use App\Models\BasicDetails\SeverityType;
use App\Models\MasterSettings\District;
use App\Models\MasterSettings\LocalBody;
use App\Models\MasterSettings\Province;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    const FILE_UPLOAD_PATH = 'uploads/documents/complaints';

    protected $fillable =
    [
        'client_id',
        'user_id',
        'complaint_no',
        'form_category_id',
        'description',
        'complaint_source_id',
        'country_id',
        'severity_type_id',
        'province_code',
        'district_code',
        'local_government_code',
        'ward',
        'tole',
        'name_ne',
        'name_en',
        'mobile_no',
        'gender_id',
        'email',
        'fb_link',
        'twitter_link',
        'skype_username',
        'disclose_complainer_info',
        'is_password_protected',
        'default_response_id',
        'is_directly_closed',
        'is_public',
        'office_id',
        'require_follow_up',
        'follow_up_date_ad',
        'follow_up_date_bs',
        'csd_response',
        'csd_response_public',
        'solved_by_call_center',
        'directly_closed',
        'office_unknown',
        'assign_jst_for_improvement',
        'file_name',
        'status',
        'complaint_date_np',
        'complaint_date_en',
        'fy_id',
        'complaint_month_code',
        'complaint_process',
        'show_personal_info',
        'appointment_no',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(MstCountry::class);
    }

    public function complaintType(): BelongsTo
    {
        return $this->belongsTo(FormCategory::class, 'form_category_id');
    }

    public function officeList(): BelongsTo
    {
        return $this->belongsTo(MstOffice::class, 'office_id');
    }

    public function complaintSource(): BelongsTo
    {
        return $this->belongsTo(ComplaintSource::class, 'complaint_source_id');
    }

    public function complaintseverityType(): BelongsTo
    {
        return $this->belongsTo(SeverityType::class, 'severity_type_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(MstGender::class, 'gender_id');
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(FormCategory::class, 'form_category_id');

    }

    public function complaintStatus(): belongsTo
    {
        return $this->belongsTo(ComplaintStatus::class, 'status', 'id');

    }

    public function complaintPriority(): belongsTo
    {
        return $this->belongsTo(SeverityType::class, 'severity_type_id');

    }

    public function office(): belongsTo
    {
        return $this->belongsTo(MstOffice::class, 'office_id');

    }

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function province(): belongsTo
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');

    }

    public function district(): belongsTo
    {
        return $this->belongsTo(District::class, 'district_code', 'code');

    }

    public function localBody(): belongsTo
    {
        return $this->belongsTo(LocalBody::class, 'local_government_code', 'code');

    }
}
