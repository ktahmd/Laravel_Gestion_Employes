<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employes;
use App\Models\User;
use App\Models\Departements;
use Exception;

class cvcontroller extends Controller
{
    public function set(Request $request, $id)
    {
        $request->validate([
          
                'nom' => 'required|string|max:255',
                'prenom'=> 'required|string|min:2',
                'tel'=> 'required|string|max:8',
                'adress' => 'required|string|max:255',
                'diplome' => 'required|string|max:255',
                'img_profit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'specialite' => 'required|string|max:255',
                'dep_id' => 'required|exists:departements,id',
            ]);
        

        $Employes = Employes::findOrFail($id);
        $Employes->nom = $request->nom;
        $Employes->prenom= $request->prenom;
        $Employes->tel = $request->tel;
        $Employes->adress = $request->adress;
        $Employes->diplome= $request->diplome;
        $Employes->img_profit = $request->img_profit;
        $Employes->specialite = $request->specialite;
        $Employes->save();

        return redirect()->route('cv.show',$id)->with('success', 'cv mis à jour avec succès.');

}
}
  