<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected array $multi_language_columns = [];
    use ObservantTrait, SoftDeletes;

    protected $casts = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multi_language_columns_casts();
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    public function getAttribute($key)
    {
        if (explode("_", $key)[0] === 'original')
            return parent::getAttribute(explode("_", $key)[1]);
        if (request()->is('api/*') || (class_basename($this) == 'Translation'))
            return parent::getAttribute($key);
        if (isset($this->casts["{$key}_translations"])) {
            if ($this["{$key}_translations"]) {
                if (isset($this["{$key}_translations"][App::currentLocale()])) {
                    if ($this["{$key}_translations"][App::currentLocale()]) {
                        return $this["{$key}_translations"][App::currentLocale()];
                    }
                }
            }
        }
        return parent::getAttribute($key);
    }

    public function getMultiLanguageColumns(): array
    {
        return $this->multi_language_columns;
    }

    public function multi_language_columns_casts()
    {
        $cast = [];
        foreach ($this->getMultiLanguageColumns() as $multiLanguageColumn) {
            $cast["{$multiLanguageColumn}_translations"] = 'array';
        }

        $this->mergeCasts($cast);
    }

    public function withTranslations($resource)
    {
        foreach ($this->getMultiLanguageColumns() as $multiLanguageColumn) {
            foreach ($this["{$multiLanguageColumn}_translations"] as $lang_code => $translation) {
                $resource["{$multiLanguageColumn}_$lang_code"] = $translation;
            }
        }
        return $resource;
    }

    public function translate_columns($validated)
    {
        foreach ($this->getMultiLanguageColumns() as $multiLanguageColumn) {
            $column_translation = [];
            foreach (app()->get('languages') as $language) {
                if (isset($validated["{$multiLanguageColumn}_$language->code"]))
                    $column_translation[$language->code] = $validated["{$multiLanguageColumn}_$language->code"];
            }
            $this["{$multiLanguageColumn}_translations"] = $column_translation;
        }
    }

    public function scopeOwnerModel($query)
    {
        if (Auth::user()) {
            $permission = class_basename($this);
            if (!Auth::user()->hasPermissionTo($permission))
                return $query->where('created_by', Auth::user()->id);
            elseif (!Auth::user()->hasAnyPermission([$permission, "$permission owner"]))
                return $query->where('id', null);
        }
    }
}
