<?php

namespace App\Models\EDMIS;

use App\Models\BasicDetails\DcMedium;
use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\MstDepartment;
use App\Models\BasicDetails\MstDocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DcDispatchBook extends Model
{
    use HasFactory;

    protected $table = 'dc_dispatch_book';

    const FILE_PATH = 'uploads/documents/chalani_kitab';

    protected $fillable = [
        'letter_no',
        'regd_no',
        'dispatch_no',
        'from_branch_id',
        'dispatch_date_bs',
        'dispatch_date_ad',
        'letter_date_bs',
        'letter_date_ad',
        'sent_medium_id',
        'country_id',
        'letter_sub',
        'bcc_id',
        'contact_no',
        'to_office_name',
        'to_office_id',
        'to_office_contact',
        'to_office_address',
        'contact_address',
        'file_type',
        'notes',
        'bodartha',
        'letter_status',
        'letter_upload',
        'branch_name',
        'contact_person',
        'fiscal_year_id',
        'dispatch_by_id',
        'dispatch_month_code',
    ];

    public function medium(): BelongsTo
    {
        return $this->belongsTo(DcMedium::class, 'sent_medium_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(MstDepartment::class, 'from_branch_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(DcStatus::class, 'letter_status');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(MstDocumentType::class, 'file_type');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(MstDocumentType::class, 'country_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(DcOffice::class, 'to_office_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dispatch_by_id');
    }
}
