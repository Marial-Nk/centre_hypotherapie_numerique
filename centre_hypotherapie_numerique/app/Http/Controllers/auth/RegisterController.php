<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Vérifie que la vue existe : `resources/views/auth/register.blade.php`
    }

    public function register(Request $request)
    {
        // Vérifier si la requête est bien reçue
        dd("Requête reçue !", $request->all());

        // Valider les données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        dd("Validation OK", $validated); // Vérifier si la validation fonctionne

        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hachage du mot de passe
        ]);

        dd("Utilisateur créé !", $user); // Vérifier si l'utilisateur est bien inséré en BD

        if ($user) {
            Session::flash('success', 'Compte créé avec succès ! Connectez-vous.');
            return redirect('/login');
        }

        Session::flash('error', 'Une erreur est survenue. Réessayez.');
        return redirect('/register');
    }
}
