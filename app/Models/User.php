<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function specialExhibitions()  //special_exhibitionsではなくreviwes?
    {
        return $this->belongsToMany(SpecialExhibition::class, 'reviews')
            ->withPivot('content')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);  //belongsToMany?
    }

    public function reviewFavorites()
    {
        return $this->belongsToMany(Review::class, 'review_favorites');
    }

    public function favorites()
    {
        return $this->belongsToMany(Museum::class, 'favorites', 'user_id', 'museum_id');
    }
}
