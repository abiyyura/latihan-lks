<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validasi data pengguna
            $data = $request->validate([
                'full_name' => 'required',
                'bio' => 'required|max:100',
                'username' => 'required|unique:users,username|min:3|regex:/^[a-zA-Z0-9._]+$/', // Memperbaiki regex dan unique
                'password' => 'required|min:6',
                'is_private' => 'boolean',
            ]);

            // Buat pengguna baru
            $user = User::create([
                'full_name' => $data['full_name'],
                'bio' => $data['bio'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'is_private' => $data['is_private'] ?? false, // Default ke false jika tidak disediakan
            ]);

            // Buat token API
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Register success', // Memperbaiki pengetikan
                'token' => $token,
                'user' => [
                    'full_name' => $user->full_name,
                    'bio' => $user->bio,
                    'username' => $user->username,
                    'is_private' => (bool) $user->is_private,
                ],
            ], 201); // 201 artinya Created

        } catch (ValidationException $e) {
            // Penanganan kesalahan validasi
            return response()->json([
                'message' => 'Invalid field', 
                'errors' => $e->errors(), 
            ], 422); 
        }
    }
}
