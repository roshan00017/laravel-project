<?php

namespace App\Models\Grevience;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    protected $fillable =
        [
            'client_id',
            'name',
            'mobile',
            'suggestions',
            'files',
            'email',
            'suggestion_category_id',
            'submit_date_np',
            'submit_date_en',
            'fy_id',
            'suggestion_month_code',
        ];

    const FILE_UPLOAD_PATH = 'uploads/documents/suggestions';

    public function suggestion_categories(): BelongsTo
    {
        return $this->belongsTo(SuggestionCategory::class, 'suggestion_category_id');
    }
}
