<?php

namespace App\Models\EDMIS;

use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Calendar\MstFiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DcDocument extends Model
{
    protected $table = 'dc_document';

    const FILE_PATH = 'uploads/files/document';

    // public $timestamps = false;
    // use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'code',
        'document_no',
        'document_type_id',
        'from_section_id',
        'to_section_id',
        'added_on',
        'added_by',
        'fiscal_year_id',
        'filepath',
        'employee_id',
        'file_status_id',
        'client_id',
        'remarks',
        'ward_no',
        'document_month_code',

    ];

    public function fiscalyear(): BelongsTo
    {
        return $this->belongsTo(MstFiscalYear::class, 'fiscal_year_id');
    }

    public function letterStatus(): BelongsTo
    {
        return $this->belongsTo(DcStatus::class, 'document_type_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function toSection(): BelongsTo
    {
        return $this->belongsTo(MstDepartment::class, 'to_section_id');
    }

    public function dcDocument(): BelongsTo
    {
        return $this->belongsTo(DcRegisterBook::class, 'document_no');
    }
}
