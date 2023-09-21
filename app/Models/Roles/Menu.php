<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'parent_id',
            'menu_name',
            'menu_controller',
            'menu_link',
            'menu_css',
            'menu_icon',
            'menu_status',
            'menu_order',
            'action_module_status',
        ];

    public $timestamps = false;

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id')->where('parent_id', 0)->with('parent');
    }
}
