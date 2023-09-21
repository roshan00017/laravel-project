<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstFederalHierarchy extends Model
{
    use HasFactory;

    protected $table = 'mst_federal_hierarchy';

    protected $fillable = [
        'code',
        'client_id',
        'master_ref_id',
        'name_en',
        'name_np',
        'parent_id',
        'federal_level_type_id',
        'description',
        'status',
        'is_current',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_uq_code',
        'client_ward',
        'name_en_backup',
        'is_old_data',
        'created_on',
        'updated_on',
        'deleted_on',
    ];
}
