<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitingPurpose extends Model
{
    use HasFactory;

    protected $table = 'visiting_purposes';

    protected $fillable =
    [
        'code',
        'name_np',
        'name_en',
        'status',
    ];
}
