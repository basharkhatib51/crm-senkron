<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Product extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'image_id',
        'price',
    ];
    protected array $multi_language_columns = [
        'name',
        'description'
    ];

    public function scopeFillter($query)
    {
        $category = request()->category;
        if ($category) {
            $all_category_children = Category::where('id', $category)->first()->all_children_id();
            return $query->whereIn('category_id', $all_category_children);
        } else
            return $query;
    }

    public static function scopeSearchable($query)
    {
        $search = request()->search;
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
        return $query;
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'image_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function product_details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function product_images(): BelongsToMany
    {
        return $this->belongsToMany(Upload::class, 'product_images', 'product_id', 'image_id');
    }

}
