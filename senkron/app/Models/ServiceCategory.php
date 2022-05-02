<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends BaseModel
{
    protected $fillable = [
        'name'
    ];
    protected array $multi_language_columns = [
        'name'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function parent_service_category(): BelongsTo
    {
        return $this->belongsTo(serviceCategory::class, 'service_category_id', 'id');
    }

    public function children_service_categories(): HasMany
    {
        return $this->hasMany(serviceCategory::class, 'service_category_id', 'id');
    }

    public function all_children_id()
    {
        $all_children = [$this];
        $categories = [$this];
        while (count($categories) > 0) {
            $nextCategories = [];
            foreach ($categories as $category) {
                $all_children = array_merge($all_children, $category->children_categories->all());
                $nextCategories = array_merge($nextCategories, $category->children_categories->all());
            }
            $categories = $nextCategories;
        }
        return collect($all_children)->pluck('id')->toArray();
    }
}
