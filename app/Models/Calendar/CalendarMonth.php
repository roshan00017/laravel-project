<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarMonth extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_np', 'name_en', 'code', 'status'];
}
