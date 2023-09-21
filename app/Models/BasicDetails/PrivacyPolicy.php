<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $fillable =
       [
           'client_id',
           'title',
           'image',
           'attachment',
           'content',
           'expiry_date_bs',
           'expiry_date',
           'status',
       ];
}
