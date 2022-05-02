<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends BaseModel
{

    protected $fillable = ['name'];

    protected array $multi_language_columns = [
        'name'
    ];

    public function slider_elements(): HasMany
    {
        return $this->hasMany(SliderElement::class);
    }

}
