<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Section extends BaseModel
{
    protected $cast = [
        'image' => 'boolean',
        'description' => 'boolean',
        'icon' => 'boolean',
        'link' => 'boolean',
    ];
    protected $fillable = [
        'name', 'elements_col', 'image', 'description', 'icon', 'link'
    ];
    protected array $multi_language_columns = [
        'name'
    ];
    public function getById($id)
    {
        $row=$this->where('id', $id)->first();
        if ($row)
            return $row;
        return null;
    }
    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }


}
