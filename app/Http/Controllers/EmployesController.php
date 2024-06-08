<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employes;
use App\Models\User;

class EmployesController extends Controller
{
    public function index()
    {
        $employes = Employes::all();
        return view('gestionPersonnel.infos', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom'=> 'required|string|min:2',
            'tel'=> 'required|string|max:8',
            'adress' => 'required|string|max:255',
            'diplome' => 'required|string|max:255',
            'img_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employe = Employes::create($request->all());

        return redirect()->route('employes.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit($id)
    {
        $employe = Employes::findOrFail($id);
        return view('employes.edit', compact('employe'));
    }

    public function destroy($id)
    {
        $employe = Employes::findOrFail($id);
        
        if ($employe->user) {
            $employe->user->delete();
        }

        $employe->delete();

        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom'=> 'required|string|min:2',
            'tel'=> 'required|string|max:8',
            'adress' => 'required|string|max:255',
            'diplome' => 'required|string|max:255',
            'img_profit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employe = Employes::findOrFail($id);
        $employe->update($request->all());

        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');

}
}