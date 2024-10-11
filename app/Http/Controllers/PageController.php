<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
    public function showCharacter( string $name):View {

        $characters = config('characters');

        if (!array_key_exists($name, $characters)) {
            abort(404, 'Character not found');
        }
        return view('fandom.character', ['character' => $characters[$name]]);
        
    }
}
