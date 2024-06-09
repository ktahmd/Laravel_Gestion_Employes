<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employes;
use App\Models\User;
use App\Models\Evaliations;
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

    public function store(Request $request)
        {
            try{
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'tel' => 'required|string|max:255',
                'adresse' => 'required|string|max:255',
                'diplome' => 'required|string|max:255',
                'specialite' => 'required|string|max:255',
                'dep_id' => 'required|exists:departements,id',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Create the evaliations
            $evaliations = Evaliations::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'tel' => $request->tel,
                'adress' => $request->adresse,
                'diplome' => $request->diplome,
                'specialite' => $request->specialite,
                'contrat_id' => null,
                'dep_id' => $request->dep_id,
                'user_id' => null,
                
            ]);
            // Get the uploaded file
            $image = $request->file('image');
            if(!empty($image)){
            // Create a unique file name
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image
            $destinationPath = $image->storeAs('public/profiles', $imageName);
            
            // Update the img_profit field
            $evaliations->img_profit = $destinationPath;
            $evaliations->save();
            }
        }catch(exception $e){
            return redirect()->route('Evaliations.index')->with('faild', 'Ooops.');
        }
            

        return redirect()->route('Evaliations.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit($id)
    {
        $evaliations = Evaliations::findOrFail($id);
        return view('Evaliations.edit', compact('evaliations'));
    }

    public function destroy($id)
    {
        $evaliations = Evaliations::findOrFail($id);
        
        if ($evaliations->user) {
            $evaliations->user->delete();
        }

        $evaliations->delete();

        return redirect()->route('Evaliations.index')->with('success', 'Employé supprimé avec succès.');
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

        $evaliations = Evaliations::findOrFail($id);
        $evaliations->update($request->all());

        return redirect()->route('Evaliations.index')->with('success', 'Employé mis à jour avec succès.');

}
}
