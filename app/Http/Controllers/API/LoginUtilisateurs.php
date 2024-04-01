<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\Exception;

class LoginUtilisateurs extends Controller
{

    public function connexion(Request $request)
    {
    try {
        $request->validate([
        'telephone' => 'telephone|required',
        'password' => 'required'
        ]);

        $credentials = request(['telephone', 'password']);

        if (!Auth::attempt($credentials)) {
        return response()->json([
            'status_code' => 500,
            'message' => 'non authoriser'
        ]);
        }

        $user = User::where('telephone', $request->telephone)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
        'status_code' => 200,
        'access_token' => $tokenResult,
        'token_type' => 'Bearer',
        ]);

    } catch (Exception $error) {
        return response()->json([
        'status_code' => 500,
        'message' => 'Error in Login',
        'error' => $error,
        ]);
    }
    }
}
