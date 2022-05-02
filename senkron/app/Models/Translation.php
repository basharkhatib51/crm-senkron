<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends BaseModel
{
    protected $fillable = [
        'content',
    ];
    protected array $multi_language_columns = [
        'content'
    ];
}
