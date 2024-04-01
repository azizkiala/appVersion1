<?php

namespace App\Http\Controllers\API;

use Exception;
use Rules\Password;
use App\Models\Cour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;


class RegisterUtilisateurs extends Controller
{

    public function enregistrer(Request $request)
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
        return response()->json([
            'msg'=>'Creation reussi',
            'status_code' => 200,
            'utilisateur'=> $user
            ]);
    }
}
