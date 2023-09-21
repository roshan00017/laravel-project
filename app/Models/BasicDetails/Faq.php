<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'question',
            'question_ne',
            'answer',
            'answer_ne',
            'status',
        ];
}
