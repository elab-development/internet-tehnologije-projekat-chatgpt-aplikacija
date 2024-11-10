<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    
    public function register(Request $request)
{
    try {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'], 
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
            ], 201); 
        }

        return response()->json([
            'success' => false,
            'message' => 'Registration failed'
        ], 500);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422); 
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Registration failed',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function login(Request $request)
{
    try {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ], 401);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function logout(Request $request)
{
    try {
        // Ensure the user is authenticated
        $user = Auth::user();
        
        if ($user) {
            // Revoke the user's current token
            $user->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error('Logout error:', ['error' => $e->getMessage()]);

        return response()->json([
            'success' => false,
            'message' => 'Logout failed',
            'error' => $e->getMessage() // Include the error message for debugging
        ], 500);
    }
}
}
