<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request; 
use App\Models\Characters; 
use App\Models\Abilities; 
use App\Models\CharacterImages; 

class PageController extends Controller
{
    
     public function home() {
        return view('home');
    }

   
    public function about() {
        return view('about');
    }


    public function contact() {
        return view('contact');
    }


    public function services() {
        return view('services');
    }

    // Метод для сторінки з параметром
    public function showCharacter( string $id):View {

       
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
            abort(404, 'Character not found');
        } 

        $gallery = explode(',', $character->images);
        $abilities = explode(',', $character->abilities);    
   
        $response = [
                   
                'name' => $character->name,          
                'full-name' => $character->{'full-name'},
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

       
        return view('fandom.character', ['character' => $response]);
        
    }


    public function characterPost(Request $request)
    {
        // Валідація даних форми
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
            'image' => 'required|string|max:20',      
            'abilities' => 'required|string|max:200',         
            'images' => 'required|string',
        ]);

        DB::transaction(function () use ($validated) {
            // Збереження персонажа
            $character = Characters::create([
                'name' => $validated['name'],
                'full-name' => $validated['full-name'],
                'status' => $validated['status'],
                'birth' => $validated['birth'],
                'race' => $validated['race'],
                'gender' => $validated['gender'],
                'age' => $validated['age'],
                'height' => $validated['height'],
                'hair' => $validated['hair'],
                'summary' => $validated['summary'],
                'biography' => $validated['biography'],
                'image' => $validated['image'],
            ]);
            
            $abilities = explode(',', $validated['abilities']);
            // Збереження здібностей
            foreach ($abilities as $ability_value) {
                Abilities::create([
                    'character_id' => $character->id,
                    'ability_value' => $ability_value,
                ]);
            }
            $images = explode(',', $validated['images']);
            // Збереження зображень
            foreach ($images  as $image_value) {
                CharacterImages::create([
                    'character_id' => $character->id,
                    'value' => $image_value,
                ]);
            }
        });

        
        return redirect()->back()->with('success', 'Персонажа успішно створено!');
    }

    public function characterUpdate(Request $request, $id)
    {
        // Валідація даних форми
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
            'image' => 'required|string|max:20',    
        
        ]);

        
    DB::transaction(function () use ($id, $validated) {
        // Оновлення персонажа
        $character = Characters::findOrFail($id);
        $character->update([
            'name' => $validated['name'],
            'full-name' => $validated['full-name'],
            'status' => $validated['status'],
            'birth' => $validated['birth'],
            'race' => $validated['race'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'height' => $validated['height'],
            'hair' => $validated['hair'],
            'summary' => $validated['summary'],
            'biography' => $validated['biography'],
            'image' => $validated['image'],
        ]);
        });
            
        
        return redirect()->back()->with('success', 'Персонажа успішно створено!');
    }

    public function characterCreate():View
    {
        return view('fandom.characterForm');
    }

    public function characterEdit(int $id):View
    {
        $character = Characters::findOrFail($id);
        $character = $character->makeHidden(['created_at', 'updated_at']);

        return view('fandom.characterFormEdit',['character' => $character]);
    }

    public function characterDelete(int $id):View
    {
        $character = Characters::findOrFail($id);
        $character = $character->makeHidden(['created_at', 'updated_at']);

        return view('fandom.characterFormDelete',['character' => $character]);
    }

    public function characterDestroy( int $id)
{
    try {
        $character = Characters::findOrFail($id);
        $character->delete();

        return redirect()->route('home')->with('success', 'Персонажа видалено успішно.');
    } catch (\Exception $e) {
        return redirect()->route('home')->with('error', 'Не вдалося видалити персонажа: ' . $e->getMessage());
    }
}

}
