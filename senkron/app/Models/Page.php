<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends BaseModel
{

    protected $fillable = [
        'title', 'image', 'background', 'content', 'excerpt', 'layout', 'status', 'slider_id'
    ];
    protected array $multi_language_columns = [
        'title', 'content', 'excerpt',
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function update_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function upload_image()
    {
        return $this->belongsTo(Upload::class, 'image', 'id');
    }

    public function upload_background()
    {
        return $this->belongsTo(Upload::class, 'background', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tag', 'page_id', 'tag_id');
    }

    public function service_category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

//    public function menus()
//    {
//        return $this->hasMany(Menu::class);
//    }

//    public function scopeOwner($query)
//    {
//        $permission = class_basename($this) . ' List';
//        if (Auth::user()->hasPermissionTo($permission))
//            return $query;
//        else
//            return $query->where('created_by', Auth::user()->id);
//    }

}
