<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLoginForm(){

        return view("auth.login");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if(auth("web")->attempt($data)) {
            $request->session()->regenerate();
            return redirect(route("home"));
        }

        return redirect(route("login"))->withErrors(["email" => "Користувач не знайден, або дані введені неправильно"]);
    }

    public function showRegisterForm(){

        return view("auth.register");
    }


    public function logout(Request $request){
        auth("web")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route("home"));
    }
    public function register(Request $request){
        
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "string", "unique:users,email"],
            "password" => ["required", "confirmed"],
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
            'profile_image' => $data['image'] ?? null,
        ]);

       
        if($user) {
            

            auth("web")->login($user);
            $request->session()->regenerate();
        }

        return redirect(route("home"));
    }


    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }


    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|max:2048', // Перевірка на зображення
        ]);


        if ($request->hasFile('profile_image')) {
        
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

        
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    
}
