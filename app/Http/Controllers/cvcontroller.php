<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employes;
use App\Models\User;
use App\Models\Departements;
use Exception;
use Illuminate\Support\Facades\Auth;

class cvcontroller extends Controller
{
    public function show($id)
    {
        $departements= Departements::all();
        $users= User::all();
        $Employes = Employes::findOrFail($id);
        
        return view('gestionPersonnel.cv', compact('Employes','users','departements')); 
    }  
        public function set(Request $request, $id)
      {
        try{
        $request->validate([
          
                'nom' => 'required|string|max:255',
                'prenom'=> 'required|string|min:2',
                'tel'=> 'required|string|max:8',
                'adress' => 'required|string|max:255',
                'diplome' => 'required|string|max:255',
                'img_profit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'specialite' => 'required|string|max:255',
                'dep_id' => 'required|exists:departements,id',
                'created_at' => 'required|date',
            ]);
        
            $image = $request->file('image');
            if(!empty($image)){
            // Create a unique file name
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image
            $destinationPath = $image->storeAs('public/profiles', $imageName);
            
            }
        $Employes = Employes::findOrFail($id);
        $Employes->nom = $request->nom;
        $Employes->prenom= $request->prenom;
        $Employes->tel = $request->tel;
        $Employes->adress = $request->adress;
        $Employes->diplome= $request->diplome;
        if(!empty($image)){
        $Employes->img_profit = $request->$destinationPath;
        }
        $Employes->specialite = $request->specialite;
        $Employes->created_at = $request->created_at;
        $Employes->save();
        if (Auth::check() && (Auth::user()->role === 'admin' ||Auth::user()->role === 'RRH')){
        if (!empty($Employes->user_id)) {
            $user = User::findOrFail($Employes->user_id);
            if ($user) {
                $user->role = $request->role;
                $user->save();
            }
        }
        }
        }catch(exception $e){
            if (Auth::check() && (Auth::user()->role != 'admin' ||Auth::user()->role === 'RRH')){
            return redirect()->route('cv.show',$id)->with('faild', 'Ooops.' . $e->getMessage());
            }
            else{
                return redirect()->route('cv.showme',$id)->with('faild', 'Ooops.' . $e->getMessage());
            }
        }
        if (Auth::check() && (Auth::user()->role === 'admin' ||Auth::user()->role === 'RRH')){
        return redirect()->route('cv.show',$id)->with('success', 'cv mis à jour avec succès.');
        }
        else{
            return redirect()->route('cv.showme',$id)->with('success', 'cv mis à jour avec succès.');
        }

}
}
