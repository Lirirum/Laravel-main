<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Characters;
use App\Models\Abilities;
use App\Models\CharacterImages;

class CharacterController extends Controller
{
    // Отримання всіх персонажів
    public function index()
    {
        $characters = Characters::get();
        return response()->json($characters, 200);
    }
    public function showById($id){
        $character = Characters::find($id);
        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }
        return response()->json($character, 200);
    }

    // Отримання одного персонажа
    public function show($id)
    {
       
        $characters = config('characters');
        
        $character = DB::table('characters')
        ->leftJoin('character_images', 'characters.id', '=', 'character_images.character_id')
        ->leftJoin('abilities', 'characters.id', '=', 'abilities.character_id')
        ->select('characters.id', 'characters.name','characters.full-name', 'characters.status', 'characters.birth', 'characters.race', 'characters.gender', 'characters.age', 'characters.height', 'characters.hair', 'characters.summary', 'characters.biography', 'characters.image',
        DB::raw('GROUP_CONCAT(DISTINCT character_images.value) as images'), 
        DB::raw('GROUP_CONCAT(DISTINCT abilities.ability_value) as abilities'))
        ->where('characters.id', $id)
        ->groupBy('characters.id', 'characters.name','characters.full-name', 'characters.status', 'characters.birth', 'characters.race', 'characters.gender', 'characters.age', 'characters.height', 'characters.hair', 'characters.summary', 'characters.biography', 'characters.image')
        ->first();

        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        $gallery = explode(',', $character->images);
        $abilities = explode(',', $character->abilities);    
   
        $response = [
                   
                'name' => $character->name,          
                'fullName' => $character->{'full-name'},
                'status' => $character->status,
                'birth' => $character->birth,
                'race' => $character->race,
                'gender' => $character->gender,
                'age' => $character->age,
                'height' => $character->height,
                'hair' => $character->hair,
                'summary' => $character->summary,
                'abilities' => $abilities,
                'biography' => $character->biography,
                'image' => $character->image,
                'gallery' => $gallery,
            
        ]; 

        return response()->json($response, 200);
    }

    // Створення персонажа
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'full-name' => 'required|string|max:100',
            'status' => 'required|string|max:50',
            'birth' => 'required|string|max:30',
            'race' => 'required|string|max:20',
            'gender' => 'required|string|max:10',
            'age' => 'required|string|max:40',
            'height' => 'required|string|max:30',
            'hair' => 'required|string|max:30',
            'summary' => 'required|string',
            'biography' => 'required|string',
            'image' => 'required|string|max:255',
            'abilities' => 'array',
            'images' => 'array',
        ]);

        $character = Characters::create($validated);

        if (isset($validated['abilities'])) {
            foreach ($validated['abilities'] as $ability) {
                Abilities::create(['character_id' => $character->id, 'ability_value' => $ability]);
            }
        }

        if (isset($validated['images'])) {
            foreach ($validated['images'] as $image) {
                CharacterImages::create(['character_id' => $character->id, 'value' => $image]);
            }
        }

        return response()->json(['message' => 'Character created successfully'], 201);
    }

    // Оновлення персонажа
    public function update(Request $request, $id)
    {
        $character = Characters::find($id);

        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:20',
            'full-name' => 'string|max:100',
            'status' => 'string|max:50',
            'birth' => 'string|max:30',
            'race' => 'string|max:20',
            'gender' => 'string|max:10',
            'age' => 'string|max:40',
            'height' => 'string|max:30',
            'hair' => 'string|max:30',
            'summary' => 'string',
            'biography' => 'string',
            'image' => 'string|max:255',
        ]);

        $character->update($validated);
        
        return response()->json(['message' => 'Character updated successfully'], 200);
    }

    // Видалення персонажа
    public function destroy($id)
    {
        $character = Characters::find($id);

        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        $character->delete();

        return response()->json(['message' => 'Character deleted successfully'], 200);
    }
}
