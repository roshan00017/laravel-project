<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingMember extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'client_id',
        'meeting_id',
        'name_en',
        'name_np',
        'office',
        'post',
        'contact_no',
        'email',
        'is_invite',
        'is_present',
        'created_by',
        'updated_by',
        'deleted_by',
        'karyapalika_member_id',
    ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
