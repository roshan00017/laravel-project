<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupChat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'group_id',
        'memeber_id',
        'message',
        'file',
        'seen',
        'msg_date_en',
        'msg_date_np',
        'deleted_by',
    ];
}
