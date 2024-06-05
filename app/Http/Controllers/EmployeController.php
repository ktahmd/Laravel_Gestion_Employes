<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\User;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::all();
        return view('employes.index', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employes',
        ]);

        $employe = Employe::create($request->all());

        return redirect()->route('employes.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit($id)
    {
        $employe = Employe::findOrFail($id);
        return view('employes.edit', compact('employe'));
    }

    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);
        
        if ($employe->user) {
            $employe->user->delete();
        }

        $employe->delete();

        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}