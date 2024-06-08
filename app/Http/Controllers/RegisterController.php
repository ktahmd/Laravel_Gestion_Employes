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
        // Validate the request
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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',  // Corrected the mime types
        ]);
        
        
        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employe',
            'permission_status' => 'inactive',
        ]);

        // Create the employe
        $employe = Employes::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'adress' => $request->adresse,
            'diplome' => $request->diplome,
            'specialite' => $request->specialite,
            'contrat_id' => null,
            'dep_id' => $request->dep_id,
            'user_id' => $user->id,
        ]);
        // Get the uploaded file
        $image = $request->file('image');
        if(!empty($image)){
        // Create a unique file name
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Store the image
        $destinationPath = $image->storeAs('public/profiles', $imageName);
        
        // Update the img_profit field
        $employe->img_profit = $destinationPath;
        $employe->save();
        }

        return redirect()->route('login')->with('success', "registre succefully");
    }
}


