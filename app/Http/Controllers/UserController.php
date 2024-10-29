<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
{
    return view('login'); 
}

    // Obrada registracije korisnika
    public function register(Request $request)
    {
        // Validacija podataka
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Kreiranje korisnika
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirektovanje korisnika na login formu
        if ($user) {
            return redirect()->route('user.login')->with('success', 'Uspešno ste registrovani!');
        } else {
            return back()->with('error', 'Došlo je do greške prilikom registracije.');
        }

    }
}
