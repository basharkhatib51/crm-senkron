<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

class Tag extends BaseModel
{

    protected $fillable = [
        'name'
    ];
    protected array $multi_language_columns = [
        'name'
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


    public function scopeOwner($query)
    {
        $permission = class_basename($this) . ' List';
        if (Auth::user()->hasPermissionTo($permission))
            return $query;
        else
            return $query->where('created_by', Auth::user()->id);
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function update_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
