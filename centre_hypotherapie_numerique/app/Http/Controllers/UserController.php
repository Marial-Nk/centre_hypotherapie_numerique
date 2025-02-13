<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        // Récupère tous les utilisateurs
        $users = User::all();

        // Retourner la vue 'utilisateur.index' avec les utilisateurs
        return view('utilisateur.index', compact('users'));
    }

    public function create()
    {
        return view('utilisateur.create');
    }

    public function logoutAndRegister(Request $request)
    {
        // Déconnecter l'utilisateur actuel
        Auth::logout();

        // Invalider la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page d'inscription
        return redirect(route('register'));
    }

    public function edit(User $user)
    {
        return view('utilisateur.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
