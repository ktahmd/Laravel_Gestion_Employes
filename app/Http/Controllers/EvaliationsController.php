<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employes;
use App\Models\User;
use App\Models\Departements;
use Exception;


class EvaliationsController extends Controller
{
    //
    public function index()
    {
        $departements= Departements::all();
        $users= User::all();
        $employes = Employes::all();
        return view('evaliation.index', compact('employes','users','departements'));
    }


    public function set(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric',
        ]);

        $Employes = Employes::findOrFail($id);
        $Employes->rating = $request->rating;
        $Employes->save();

        return redirect()->route('evaliations.index')->with('success', 'Evaliation mis à jour avec succès.');

}
}
