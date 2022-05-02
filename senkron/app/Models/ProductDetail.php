<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDetail extends BaseModel
{
    protected $fillable = [
        'key',
        'value',
    ];
    protected array $multi_language_columns = [
        'key',
        'value',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
