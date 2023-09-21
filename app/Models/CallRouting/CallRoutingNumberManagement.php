<?php

namespace App\Models\CallRouting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallRoutingNumberManagement extends Model
{
    protected $table = 'call_routing_number_managements';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'fy_id',
        'client_id',
        'type',
        'number',
        'details',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
