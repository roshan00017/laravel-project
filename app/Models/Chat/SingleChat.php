<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SingleChat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'from_user_id',
        'to_user_id',
        'message',
        'file',
        'seen',
        'msg_date_en',
        'msg_date_np',
        'deleted_by',
    ];
}
