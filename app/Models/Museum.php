<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description', 'access', 'highlights', 'special_exhibition'];
    protected $table = 'museums';
}
