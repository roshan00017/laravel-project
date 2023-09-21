<?php

namespace App\Models\BasicDetails;

use Illuminate\Database\Eloquent\Model;

class MstDocumentType extends Model
{
    protected $table = 'mst_document_type';

    protected $fillable =
        [
            'code',
            'name_np',
            'name_en',
            'status',
        ];
}
