<?php

namespace App\Models\Grevience;

use Illuminate\Database\Eloquent\Model;

class SuggestionCategory extends Model
{
    protected $table = 'suggestion_categories';

    protected $fillable =
        [
            'code',
            'name',
            'name_ne',
            'status',
        ];
}
