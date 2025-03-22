<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialExhibition extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'official_website', 'museum_id'];

    public function museum()
    {
        return $this->belongsTo(Museum::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
    return $this->belongsToMany(User::class, 'user_special_exhibition');
    }
}
