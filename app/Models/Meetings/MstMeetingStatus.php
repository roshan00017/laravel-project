<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstMeetingStatus extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'code',
            'name_en',
            'name_np',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
}
