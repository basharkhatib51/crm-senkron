<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ObservantTrait, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'user_name', 'phone'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function uploaded_avatar(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'avatar_id', 'id');
    }
//    public static function booted(){
//        static::addGlobalScope(new OwnerScope);
//    }
    public function scopeAllModel($query)
    {
        return $query->withoutGlobalScope(OwnerScope::class);
    }
}
