<?php

namespace App\Models\EDMIS;

use Illuminate\Database\Eloquent\Model;

class StandingListType extends Model
{
    protected $table = 'standing_list_types';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name_en',
        'name_np',
        'status',
        'parent_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
