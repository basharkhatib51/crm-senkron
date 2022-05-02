<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends BaseModel
{
    protected $fillable = [
        'title',
        'image_id',
        'section_id',
        'pack',
        'icon',
        'description',
    ];
    protected array $multi_language_columns = [
        'title','description'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'menu_id', 'id');
    } public function image(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'image_id', 'id');
    }
    public function getUrlAttribute($val){
        if($this->page)
            return "/page/{$this->page?->original_title}";
        return $val;
    }
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
