<?php

namespace App\Models;


/**
 * @method static create(array $validated)
 */
class Upload extends BaseModel
{
    protected $appends = ['min_url'];

    public function getMinUrlAttribute()
    {
        return substr($this->url, 0, -strlen($this->extension) - 1) . '100x100.' . $this->extension;

    }

}
