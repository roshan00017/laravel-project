<?php

namespace App\Models\EDMIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandingList extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'date_np',
        'date_en',
        'status',
        'organization',
        'description',
        'regd_no',
        'physical_year_id',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the user who created the standing list.
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the standing list.
     */
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the user who deleted the standing list.
     */
    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
