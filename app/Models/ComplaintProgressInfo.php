<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintProgressInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'complaint_id',
        'description',
        'responding_office',
        'status',

    ];

    public function userInfo(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
