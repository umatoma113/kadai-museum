<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description', 'access', 'highlights'];
    protected $table = 'museums';

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function specialExhibitions()
    {
        return $this->hasMany(SpecialExhibition::class);
    }
}
