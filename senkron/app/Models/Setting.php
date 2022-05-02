<?php

namespace App\Models;

class Setting extends BaseModel
{
    protected $fillable = [
        'key', 'value', 'default', 'option', 'type', 'pack', 'icon', 'tab', 'index',
    ];

    public function getByKey($key)
    {
        $row=$this->where('key', $key)->first();
        if ($row)
            return $row->value;
        return null;
    }

    public function getById($id)
    {
        $row=$this->where('id', $id)->first();
        if ($row)
            return $row->value;
        return null;
    }

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function getValueAttribute($value)
    {
        if ($this->type == 'image' && $value) {
            return (int)$value;
        }
        return $value;
    }

    public function scopeOwner($query)
    {
        $permission = class_basename($this) . ' List';
        if (Auth::user()->hasPermissionTo($permission))
            return $query;
        else
            return $query->where('created_by', Auth::user()->id);
    }
}
