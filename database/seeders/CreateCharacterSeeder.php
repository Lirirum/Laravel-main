<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateCharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Збереження персонажа
            $characterId = DB::table('characters')->insertGetId([
                'name' => 'Sasuke',
                'full-name' => 'Sasuke Uchiha',
                'status' => 'Alive',
                'birth' => 'July 23',
                'race' => 'Human',
                'gender' => 'Male',
                'age' => '33',
                'height' => '183 cm',
                'hair' => 'Black',
                'summary' => 'Sasuke Uchiha is one of the last surviving members of Konohagakure\'s Uchiha clan...',
                'biography' => 'Sasuke was born into the Uchiha clan as the younger son of Fugaku and Mikoto Uchiha...',
                'image' => 'sasuke.jpg',
                'created_at' => now(),  
                'updated_at' => now(),  
            ]);
        
            
        });
    }
}
