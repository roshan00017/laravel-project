<?php

namespace App\Models\EDMIS;

use App\Models\MasterSettings\AppClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    const EMPLOYEE_PROFILE_PATH = 'uploads/employees/profiles';

    protected $table = 'hr_employee';

    protected $fillable =
    [
        'client_id',
        'code',
        'first_name_np',
        'middle_name_np',
        'last_name_np',
        'first_name_en',
        'middle_name_en',
        'last_name_en',
        'dob_bs',
        'dob_ad',
        'phone_number',
        'email',
        'ward_no',
        'branch_id',

    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(AppClient::class, 'client_id');
    }
}
