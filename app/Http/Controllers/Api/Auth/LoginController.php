<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    //

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);

    }
    public function validateToken(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return response()->json([
                'message' => 'Token is valid',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid token',
            ], 401);
        }
    }

    public function _invoke(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:1',
        ]);

        if(auth()->attempt($credentials)){
            $user   = auth()->user();
            $token  = $user->createToken('auth_token', ['*'], Carbon::now()->addDays(7))
                        ->plainTextToken;

            return response()->json([
                'user_id' => $user->id,
                'username' => $user->name,
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
