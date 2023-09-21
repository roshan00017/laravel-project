<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarWeekDay extends Model
{
    use HasFactory;

    protected $fillable = ['name_np', 'name_en', 'code', 'status'];
}
