<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoraireTravails;

class HoraireTravailsController extends Controller
{
    public function index()
    {
        $horaires = HoraireTravails::all();
        return view('horaires.index', compact('horaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_jour' => 'required|date',
            'heur_debit' => 'required|date_format:H:i',
            'heur_fin' => 'required|date_format:H:i',
            'employe_id' => 'required|exists:App\Models\Employes,employe_id',
        ]);

        $horaire = HoraireTravails::create($request->all());

        return redirect()->route('horaires.index')->with('success', 'Horaire ajouté avec succès.');
    }

    public function edit($id)
    {
        $horaire = HoraireTravails::findOrFail($id);
        return view('horaires.edit', compact('horaire'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_jour' => 'required|date',
            'heur_debit' => 'required|date_format:H:i',
            'heur_fin' => 'required|date_format:H:i',
            'employe_id' => 'required|exists:App\Models\Employes,employe_id',
        ]);

        $horaire = HoraireTravails::findOrFail($id);
        $horaire->update($request->all());

        return redirect()->route('horaires.index')->with('success', 'Horaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $horaire = HoraireTravails::findOrFail($id);
        $horaire->delete();

        return redirect()->route('horaires.index')->with('success', 'Horaire supprimé avec succès.');
    }
}
