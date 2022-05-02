<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OwnerScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::user()) {
            $permission = class_basename($this) . ' List';
            if (!Auth::user()->hasPermissionTo($permission))
                $builder->where('created_by', Auth::user()->id);
            elseif (!Auth::user()->hasAnyPermission([$permission, "$permission owner"]))
                $builder->where('id', null);
        }
    }
}
