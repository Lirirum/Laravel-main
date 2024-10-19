<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    use HasFactory;
    protected $table = 'characters';
    protected $fillable = ['name', 'full-name', 'status', 'birth', 'race', 'gender', 'age', 'height', 'hair', 'summary', 'biography', 'image'];
}
