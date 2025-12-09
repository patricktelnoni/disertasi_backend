<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function _invoke(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:1',
        ]);

        if(auth()->attempt($credentials)){
            $user   = auth()->user();
            $token  = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
