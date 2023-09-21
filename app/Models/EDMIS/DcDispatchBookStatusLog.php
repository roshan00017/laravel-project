<?php

namespace App\Models\EDMIS;

use App\Models\BasicDetails\DcStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DcDispatchBookStatusLog extends Model
{
    use HasFactory;

    protected $table = 'dc_dispatch_book_status_logs';

    protected $fillable = [
        'client_id',
        'dc_dispatch_book_id',
        'status_id',
        'update_date_np',
        'update_date_en',
        'updated_by',
    ];

    public function dcDispatch(): BelongsTo
    {
        return $this->belongsTo(DcDispatchBook::class, 'dc_dispatch_book_id');
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
