<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'museum_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function museum()
    {
        return $this->belongsTo(Museum::class);
    }

    public function favorites()
    {
        return $this->hasMany(ReviewFavorite::class);
    }
}
