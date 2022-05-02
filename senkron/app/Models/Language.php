<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Language extends BaseModel
{
    protected $fillable = [
        'name',
        'english_name',
        'code',
        'image_id'
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'image_id', 'id');
    }
}
