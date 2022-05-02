<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends BaseModel
{
    protected $fillable = [
        'name', 'type', 'url', 'menu_id'
    ];
    protected array $multi_language_columns = [
        'name'
    ];

    public function getValueAttribute()
    {
        if ($this->url == null||$this->children_menus->count()>0) {
            return "#";
        }
        if ($this->type === 'url') {
            return $this->url;
        } elseif ($this->type === 'page') {
            return "/page/{$this->page?->original_title}";
//            return "/page/$this->url";
        }
    }

    public function parent_menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'url', 'id');
    }

    public function children_menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'menu_id', 'id');
    }
}
