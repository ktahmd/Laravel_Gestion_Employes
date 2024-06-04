<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'diplome' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'dep_id' => 'required|exists:departements,id',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('profiles', 'public');

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'role',
            'permission_status' => 'inactive',
        ]);

        $employe = Employes::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'adress' => $request->adresse,
            'img_profit' => $imagePath,
            'diplome' => $request->diplome,
            'specialite' => $request->specialite,
            'contrat_id' => null,
            'dep_id' => $request->dep_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('login')->with('success','registre successfully');
    }
}

