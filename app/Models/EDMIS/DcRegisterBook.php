<?php

namespace App\Models\EDMIS;

use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Calendar\MstFiscalYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DcRegisterBook extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dc_regd_book';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    const FILE_PATH = 'uploads/files/darta_kitab';

    protected $fillable =
    [
        'code',
        'regd_no',
        'regd_date_bs',
        'regd_date_ad',
        'letter_no',
        'letter_date_bs',
        'letter_date_ad',
        'dispatch_no',
        'is_foreign',
        'country_id',
        'is_person',
        'from_off_id',
        'from_office_name',
        'from_office_address',
        'letter_sub',
        'to_branch_id',
        'first_person_id',
        'regd_by_id',
        'fee_applicable',
        'reg_fee',
        'notes',
        'user_id',
        'entry_date_bs',
        'entry_date_ad',
        'is_sms_sent',
        'contact_person',
        'contact_no',
        'contact_address',
        'client_id',
        'fiscal_year_id',
        'letter_status',
        'ward_no',
        'reg_receipt',
        'reg_name',
        'document_types',
        'received_office_person',
        'received_office_name',
        'received_contact_person',
        'received_contact_address',
        'received_contact_mobile',
        'letter_upload',
        'confidentiality',
        'priority',
        'created_at',
        'updated_at',
        'register_month_code',

    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(MstCountry::class, 'country_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(MstDepartment::class, 'to_branch_id');
    }

    public function dcoffice(): BelongsTo
    {
        return $this->belongsTo(DcOffice::class, 'from_off_id');

    }

    public function patraReceiver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'first_person_id');
    }

    public function letterStatus(): BelongsTo
    {
        return $this->belongsTo(DcStatus::class, 'letter_status');
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(MstFiscalYear::class, 'fiscal_year_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'regd_by_id');

    }

    public function fiscal(): BelongsTo
    {
        return $this->belongsTo(MstFiscalYear::class, 'fiscal_year_id');

    }
}
