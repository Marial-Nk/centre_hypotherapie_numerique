<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        require public_path('auth/login.php');
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        // Recherche de l'utilisateur
        $user = User::where('name', $request->input('name'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            Session::put('user', $user);
            return redirect('/dashboard');
        }

        return "Nom ou mot de passe incorrect";
    }
}
