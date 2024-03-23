<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'telephone' => ['required', 'min:10'],
            'password' => ['required', 'min:8'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('connexion_user');
        }

        return back()->withErrors([
            response()->json('Identifiants incorrects.'),
        ])->onlyInput('telephone');
    }
}
