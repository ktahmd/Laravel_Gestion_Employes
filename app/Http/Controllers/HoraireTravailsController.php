<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoraireTravails;
use App\Models\Employes;
use Illuminate\Routing\Redirector;
use DateTime;
use Exception;

class HoraireTravailsController extends Controller
{
    public function index()
    {
        $horaires = HoraireTravails::all();
        $employes = Employes::all();
        return view('gestionPresences.index', compact('horaires','employes'));
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'date_jour' => 'required|date',
            'heur_debit' => 'required|date_format:H:i',
            'heur_fin' => 'required|date_format:H:i',
            'employe_id' => 'required',
        ]);

        // Convertir les heures en format de date
        $HD = new DateTime($request->heur_debit);
        $HF = new DateTime($request->heur_fin);

        // Calculer les heures normales (HN) (8h:00 - 17h:00)
        $HND = new DateTime('08:00');
        $HNF = new DateTime('17:00');
        $HN = 0;

        if ($HD < $HND) {
            $HD = $HND;
        }

        if ($HF > $HNF) {
            $HF = $HNF;
        }

        // Calculer les heures normales
        $interval = $HD->diff($HF);
        $HN = $interval->h + ($interval->i / 60);

        // Calculer les heures supplémentaires (HS)
        $HSDeb = new DateTime($request->heur_debit);
        $HSFin = new DateTime($request->heur_fin);
        $HS = 0;

        if ($HSDeb < $HND) {
            $intervalHS1 = $HSDeb->diff($HND);
            $HS += $intervalHS1->h + ($intervalHS1->i / 60);
        }

        if ($HSFin > $HNF) {
            $intervalHS2 = $HNF->diff($HSFin);
            $HS += $intervalHS2->h + ($intervalHS2->i / 60);
        }

        // Calculer les heures d'absence (HA)
        $HA = 9 - $HN; // 9 heures de travail normal - heures normales travaillées

        // Enregistrer les résultats dans la base de données
        $horaire = new HoraireTravails();
        $horaire->date_jour = $request->date_jour;
        $horaire->heur_debit = $request->heur_debit;
        $horaire->heur_fin = $request->heur_fin;
        $horaire->employe_id = $request->employe_id;
        $horaire->HN = $HN;
        $horaire->HS = $HS;
        $horaire->HA = $HA;
        $horaire->save();
        }catch(exception $e){
            \Log::error('Error storing horaire: ' . $e->getMessage());
            return redirect()->route('HoraireTravails.index')->with('faild', 'Ooops '.$e->getMessage());
        }

        return redirect()->route('HoraireTravails.index')->with('success', 'Horaire ajouté avec succès.');
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
    public function show($id)
    {
        // Fetch the HoraireTravail record from the database
        $horaires = HoraireTravails::where('employe_id', $id)->get();
        $employes = Employes::findOrFail($id);
        $moisAnnees = $horaires->map(function($horaire) {
            $date = new \DateTime($horaire->date_jour);
            return $date->format('m/Y');
        })->unique();

        // Get the selected month from the request or default to the current month
        $selectedMonth = request('month', $moisAnnees->first());

        // Calculate the totals and percentages for the selected month
        $percentages = $this->calculatePercentages($horaires, $selectedMonth);

        // Return a view with the fetched HoraireTravail data
        return view('performance.index', compact('horaires','id', 'employes', 'moisAnnees', 'percentages'));
    }

    private function calculatePercentages($horaires, $month)
    {
        $filtered = $horaires->filter(function($horaire) use ($month) {
            $date = new \DateTime($horaire->date_jour);
            return $date->format('m/Y') == $month;
        });
    
        $totalHours = $filtered->sum('HN') + $filtered->sum('HS') + $filtered->sum('HA');
        if ($totalHours == 0) {
            return [
                'presence' => 0,
                'extra' => 0,
                'absence' => 0,
                'totalPresence' => '00h:00min',
                'totalExtra' => '00h:00min',
                'totalAbsence' => '00h:00min',
            ];
        }
    
        $totalPresence = $filtered->sum('HN');
        $totalExtra = $filtered->sum('HS');
        $totalAbsence = $filtered->sum('HA');
    
        $presenceHours =  (int)$totalPresence;
        $presenceMinutes =  ($totalPresence - (int)$totalPresence) * 60;
    
        $extraHours = (int)$totalExtra;
        $extraMinutes = ($totalExtra - (int)$totalExtra) * 60;
    
        $absenceHours = (int)$totalAbsence;
        $absenceMinutes = ($totalAbsence - (int)$totalAbsence) * 60;
    
       
        return [
            'presence' => number_format(($totalPresence / $totalHours) * 100, 1),
            'extra' => number_format(($totalExtra / $totalHours) * 100, 1),
            'absence' => number_format(($totalAbsence / $totalHours) * 100, 1),
            'totalPresence' => sprintf('%02dh:%02dmin', $presenceHours, $presenceMinutes),
            'totalExtra' => sprintf('%02dh:%02dmin', $extraHours, $extraMinutes),
            'totalAbsence' => sprintf('%02dh:%02dmin', $absenceHours, $absenceMinutes),
        ];
    }
    



}
