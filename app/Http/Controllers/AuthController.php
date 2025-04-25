<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for handling authentication operations
 * Manages user login and logout functionality
 */
class AuthController extends Controller
{
    /**
     * Handle user login attempt
     * Validates credentials and generates API token
     *
     * @param Request $request The incoming HTTP request
     * @return \Illuminate\Http\JsonResponse Returns token or error message
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Handle user logout
     * Revokes the current API token
     *
     * @param Request $request The incoming HTTP request
     * @return \Illuminate\Http\JsonResponse Returns success message
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}