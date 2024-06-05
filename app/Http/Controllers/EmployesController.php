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
        return view('employes.index', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employes',
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
}