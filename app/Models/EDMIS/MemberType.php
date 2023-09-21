<?php

namespace App\Models\EDMIS;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $table = 'member_types';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name_en',
        'name_np',
        'description',
        'status',
    ];
}
