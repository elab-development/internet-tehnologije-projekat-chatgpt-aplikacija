<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

public function showMainForm()
{
    if (Auth::check()) {
        $user = Auth::user();
        $conversations = Conversation::with('messages')->where('user_id', $user->id)->get();

        return view('mainform', [
            'conversations' => $conversations
        ]);
    }

    return redirect()->route('user.login');
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

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           
            return redirect()->intended('mainform')->with('success', 'You are logged in!');
        }

        
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
{
    Auth::logout();
    return redirect()->route('user.login')->with('success', 'You have been logged out.');
}
}
