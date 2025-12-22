<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function _invoke(Request $request)
    {
        $user = User::create($request->all());
        $token = $user->createToken('auth_token',['*'], now()->addWeek())->plainTextToken;
        
        return response()->json([
            'message' => 'Register endpoint is working',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
