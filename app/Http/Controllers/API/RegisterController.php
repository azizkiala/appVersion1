<?php

namespace App\Http\Controllers\API;

use Rules\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;


class RegisterController extends Controller
{

    public function store_user(Request $request)
    {
        $file = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telephone' => ['required', 'string', 'min:10', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $user = new User();
        $user->name = $file['name'];
        $user->email = $file['email'];
        $user->telephone = $file['telephone'];
        $user->password = Hash::make($file['password']);
        $user->save();
        $token = $user->createToken('nouveau_token')->plainTextToken();
        Auth::login($user);
        return response()->json($user, 201);
    }
}
