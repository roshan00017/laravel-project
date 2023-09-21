<?php

namespace App\Models\Dcc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBodyType extends Model
{
    use HasFactory;

    protected $table = 'service_types';

    protected $dates = ['deleted_at'];

    protected $fillable =
    [
        'name_np',
        'name_en',
        'code',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
