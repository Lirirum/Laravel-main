<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    use HasFactory;

    protected $table = 'abilities';
    protected $fillable = [
        'character_id', 
        'ability_value',
    ];
    public $timestamps = false;
}
