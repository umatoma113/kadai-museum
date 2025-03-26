<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'special_exhibition_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialExhibition()
    {
        return $this->belongsTo(SpecialExhibition::class);
    }

    public function favorites()
    {
        return $this->hasMany(ReviewFavorite::class);
    }

    public function reviewFavorites()
    {
    return $this->hasMany(ReviewFavorite::class);
    }
}
