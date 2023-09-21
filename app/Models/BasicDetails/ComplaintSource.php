<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class ComplaintSource extends Model
{
    protected $fillable =
        [
            'code',
            'name',
            'name_ne',
            'status',
            'depth',
            'social_media_link',
        ];
}
