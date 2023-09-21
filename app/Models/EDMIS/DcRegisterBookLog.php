<?php

namespace App\Models\EDMIS;

use App\Models\BasicDetails\DcStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DcRegisterBookLog extends Model
{
    use HasFactory;

    protected $table = 'dc_regd_book_status_logs';

    protected $fillable =
        [
            'update_date_np',
            'update_date_en',
            'updated_by',
            'client_id',
            'dc_regd_book_id',
            'status_id',
        ];

    public function dcRegister(): BelongsTo
    {
        return $this->belongsTo(DcRegisterBook::class, 'dc_regd_book_id');
    }

    public function dcStatus(): BelongsTo
    {
        return $this->belongsTo(DcStatus::class, 'status_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
