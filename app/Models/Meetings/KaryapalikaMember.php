<?php

namespace App\Models\Meetings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryapalikaMember extends Model
{
    use HasFactory;

    const KARYAPALIKA_MEMBER_PROFILE_PATH = 'uploads/karyapalikaMembers';

    protected $fillable =
        [
            'name_en',
            'name_np',
            'designation',
            'mobile',
            'email',
            'image',
        ];
}
