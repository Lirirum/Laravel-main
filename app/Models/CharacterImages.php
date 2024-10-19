<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterImages extends Model
{
    use HasFactory;
    protected $table = 'character_images';
    protected $fillable = [
        'character_id', 
        'value',
    ];
    public $timestamps = false;
}
