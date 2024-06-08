<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conges;

class CongesController extends Controller
{
    public function index()
    {
        $conges = Conges::all();
        return view('conges.index', compact('conges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'duree' => 'required|integer',
            'date_conge' => 'required|date',
            'date_prise' => 'required|integer',
            'employe_id' => 'required|exists:App\Models\Employes,employe_id',
        ]);

        $conge = Conges::create($request->all());

        return redirect()->route('conges.index')->with('success', 'Congé ajouté avec succès.');
    }

    public function edit($id)
    {
        $conge = Conges::findOrFail($id);
        return view('conges.edit', compact('conge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'duree' => 'required|integer',
            'date_conge' => 'required|date',
            'date_prise' => 'required|integer',
            'employe_id' => 'required|exists:App\Models\Employes,employe_id',
        ]);

        $conge = Conges::findOrFail($id);
        $conge->update($request->all());

        return redirect()->route('conges.index')->with('success', 'Congé mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $conge = Conges::findOrFail($id);
        $conge->delete();

        return redirect()->route('conges.index')->with('success', 'Congé supprimé avec succès.');
    }
}

