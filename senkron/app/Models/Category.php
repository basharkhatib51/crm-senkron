<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    protected $fillable = [
        'name', 'image_id'
    ];
    protected array $multi_language_columns = [
        'name'
    ];


    public function image(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'image_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent_category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function children_categories(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
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
