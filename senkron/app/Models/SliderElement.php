<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SliderElement extends BaseModel
{
    protected $fillable = ['title', 'image', 'background', 'content', 'content_position'];
    protected array $multi_language_columns = [
        'title',
        'content'
    ];

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'image_id', 'id');
    }

    public function background(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }

}
