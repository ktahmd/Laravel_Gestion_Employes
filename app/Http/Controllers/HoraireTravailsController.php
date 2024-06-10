<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoraireTravails;
use App\Models\Employes;
use Illuminate\Validation\Rule;
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
        try {
            $request->validate([
                'date_jour' => [
                'required',
                'date',
                Rule::unique('horaire_travails')->where(function ($query) use ($request) {
                    return $query->where('employe_id', $request->employe_id);
                })
            ],
                'heur_fin' => [
                    'required_if:employe_monte,oui',
                    'date_format:H:i'
                ],
                'heur_debit' => [
                    'required_if:employe_monte,oui',
                    'date_format:H:i'
                ],
                'employe_id' => 'required',
                'employe_monte' => 'required|in:oui,non',
            ]);
            if ($request->input('employe_monte') === 'non') {
                $request->merge([
                    'heur_debit' => '00:00',
                    'heur_fin' => '00:00'
                ]);
                $HD = new DateTime($request->heur_debit);
                $HF = new DateTime($request->heur_fin);
                
                $dateJour = new DateTime($request->date_jour);
                $jourSemaine = $dateJour->format('N'); // 1 (lundi) - 7 (dimanche)
                $dateString = $dateJour->format('d/m'); // pour vérifier les jours fériés
                if ($jourSemaine == 5) { // Vendredi
                    $HN=0;
                    $HS=0;
                    $HA=4;
                } elseif ($jourSemaine == 6 || $jourSemaine == 7 || in_array($dateString, ['01/01', '01/05', '25/05', '28/09', '25/12'])) { // Samedi, Dimanche, et jours fériés
                    $HN=0;
                    $HS=0;
                    $HA=0;
                } else { // Autres jours
                    $HN=0;
                    $HS=0;
                    $HA=9;
                }

            }
            else{
                $HD = new DateTime($request->heur_debit);
                $HF = new DateTime($request->heur_fin);
                
                $dateJour = new DateTime($request->date_jour);
                $jourSemaine = $dateJour->format('N'); // 1 (lundi) - 7 (dimanche)
                $dateString = $dateJour->format('d/m'); // pour vérifier les jours fériés
        

                if ($jourSemaine == 5) { // Vendredi
                    $HND = new DateTime('08:00');
                    $HNF = new DateTime('12:00');
                    // Calculer (HN)
                    $HN = 0;
                    if ($HD < $HND) {
                        $HD = $HND;
                    }
                    if ($HF > $HNF) {
                        $HF = $HNF;
                    }
            
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

                    $HA = 4 - $HN; 
                } elseif ($jourSemaine == 6 || $jourSemaine == 7 || in_array($dateString, ['01/01', '01/05', '25/05', '28/09', '25/12'])) { // Samedi, Dimanche, et jours fériés
                    $HND = new DateTime('00:00');
                    $HNF = new DateTime('00:00');
                    // Calculer les heures normales (HN)
                    $HN = 0;
                    $interval = $HD->diff($HF);
                    $HS = $interval->h + ($interval->i / 60);
                    $HA=0;
                } else { // Autres jours
                    $HND = new DateTime('08:00');
                    $HNF = new DateTime('17:00');
                    // Calculer (HN)
                    $HN = 0;
                    if ($HD < $HND) {
                        $HD = $HND;
                    }
                    if ($HF > $HNF) {
                        $HF = $HNF;
                    }
            
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

                    $HA = 9 - $HN; 
                }
        }
    
            
            $horaire = new HoraireTravails();
            $horaire->date_jour = $request->date_jour;
            $horaire->heur_debit = $request->heur_debit;
            $horaire->heur_fin = $request->heur_fin;
            $horaire->employe_id = $request->employe_id;
            $horaire->HN = $HN;
            $horaire->HS = $HS;
            $horaire->HA = $HA;
            $horaire->save();
        } catch (Exception $e) {
            return redirect()->route('HoraireTravails.index')->with('faild', 'Ooops ' . $e->getMessage());
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
        try {
            $request->validate([

                'heur_fin_MOD' => [
                    'required_if:employe_monte,oui',
                    'date_format:H:i'
                ],
                'heur_debit_MOD' => [
                    'required_if:employe_monte,oui',
                    'date_format:H:i'
                ],

                'employe_monte_MOD' => 'required|in:oui,non',
            ]);
            if ($request->input('employe_monte_MOD') === 'non') {
                $request->merge([
                    'heur_debit_MOD' => '00:00',
                    'heur_fin_MOD' => '00:00'
                ]);
                $HD = new DateTime($request->heur_debit_MOD);
                $HF = new DateTime($request->heur_fin_MOD);
                
                $dateJour = new DateTime($request->date_jour_MOD);
                $jourSemaine = $dateJour->format('N'); // 1 (lundi) - 7 (dimanche)
                $dateString = $dateJour->format('d/m'); // pour vérifier les jours fériés
                if ($jourSemaine == 5) { // Vendredi
                    $HN=0;
                    $HS=0;
                    $HA=4;
                } elseif ($jourSemaine == 6 || $jourSemaine == 7 || in_array($dateString, ['01/01', '01/05', '25/05', '28/09', '25/12'])) { // Samedi, Dimanche, et jours fériés
                    $HN=0;
                    $HS=0;
                    $HA=0;
                } else { // Autres jours
                    $HN=0;
                    $HS=0;
                    $HA=9;
                }

            }
            else{
                $HD = new DateTime($request->heur_debit_MOD);
                $HF = new DateTime($request->heur_fin_MOD);
                
                $dateJour = new DateTime($request->date_jour_MOD);
                $jourSemaine = $dateJour->format('N'); // 1 (lundi) - 7 (dimanche)
                $dateString = $dateJour->format('d/m'); // pour vérifier les jours fériés
        

                if ($jourSemaine == 5) { // Vendredi
                    $HND = new DateTime('08:00');
                    $HNF = new DateTime('12:00');
                    // Calculer (HN)
                    $HN = 0;
                    if ($HD < $HND) {
                        $HD = $HND;
                    }
                    if ($HF > $HNF) {
                        $HF = $HNF;
                    }
            
                    $interval = $HD->diff($HF);
                    $HN = $interval->h + ($interval->i / 60);
            
                    // Calculer les heures supplémentaires (HS)
                    $HSDeb = new DateTime($request->heur_debit_MOD);
                    $HSFin = new DateTime($request->heur_fin_MOD);
                    $HS = 0;
            
                    if ($HSDeb < $HND) {
                        $intervalHS1 = $HSDeb->diff($HND);
                        $HS += $intervalHS1->h + ($intervalHS1->i / 60);
                    }
            
                    if ($HSFin > $HNF) {
                        $intervalHS2 = $HNF->diff($HSFin);
                        $HS += $intervalHS2->h + ($intervalHS2->i / 60);
                    }

                    $HA = 4 - $HN; 
                } elseif ($jourSemaine == 6 || $jourSemaine == 7 || in_array($dateString, ['01/01', '01/05', '25/05', '28/09', '25/12'])) { // Samedi, Dimanche, et jours fériés
                    $HND = new DateTime('00:00');
                    $HNF = new DateTime('00:00');
                    // Calculer les heures normales (HN)
                    $HN = 0;
                    $interval = $HD->diff($HF);
                    $HS = $interval->h + ($interval->i / 60);
                    $HA=0;
                } else { // Autres jours
                    $HND = new DateTime('08:00');
                    $HNF = new DateTime('17:00');
                    // Calculer (HN)
                    $HN = 0;
                    if ($HD < $HND) {
                        $HD = $HND;
                    }
                    if ($HF > $HNF) {
                        $HF = $HNF;
                    }
            
                    $interval = $HD->diff($HF);
                    $HN = $interval->h + ($interval->i / 60);
            
                    // Calculer les heures supplémentaires (HS)
                    $HSDeb = new DateTime($request->heur_debit_MOD);
                    $HSFin = new DateTime($request->heur_fin_MOD);
                    $HS = 0;
            
                    if ($HSDeb < $HND) {
                        $intervalHS1 = $HSDeb->diff($HND);
                        $HS += $intervalHS1->h + ($intervalHS1->i / 60);
                    }
            
                    if ($HSFin > $HNF) {
                        $intervalHS2 = $HNF->diff($HSFin);
                        $HS += $intervalHS2->h + ($intervalHS2->i / 60);
                    }

                    $HA = 9 - $HN; 
                }
        }
    
        $horaire = HoraireTravails::findOrFail($id);
        $horaire->date_jour = $request->date_jour_MOD;
        $horaire->heur_debit = $request->heur_debit_MOD;
        $horaire->heur_fin = $request->heur_fin_MOD;
        $horaire->employe_id = $request->employe_id_MOD;
        $horaire->HN = $HN;
        $horaire->HS = $HS;
        $horaire->HA = $HA;
        $horaire->save();


        } catch (Exception $e) {
            return redirect()->route('HoraireTravails.index')->with('faild', 'Ooops ' . $e->getMessage());
        }
        
        return redirect()->route('HoraireTravails.index')->with('success', 'Horaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $horaire = HoraireTravails::findOrFail($id);
        $horaire->delete();

        return redirect()->route('HoraireTravails.index')->with('success', 'Horaire supprimé avec succès.');
    }
    public function show($id)
    {
        // Fetch the HoraireTravail record from the database
        $horaire = HoraireTravails::where('employe_id', $id)->get();
        $employes = Employes::findOrFail($id);
        $moisAnnees = $horaire->map(function($horaire) {
            $date = new \DateTime($horaire->date_jour);
            return $date->format('m/Y');
        })->unique();

        // Get the selected month from the request or default to the current month
        $selectedMonth = request('month', $moisAnnees->first());

        $horaires = $horaire->filter(function($horaire) use ($selectedMonth) {
            $date = new \DateTime($horaire->date_jour);
            return $date->format('m/Y') === $selectedMonth;
        });

        // Calculate the totals and percentages for the selected month
        $percentages = $this->calculatePercentages($horaire, $selectedMonth);

        // Return a view with the fetched HoraireTravail data
        return view('performance.index', compact('horaires','id', 'employes','selectedMonth', 'moisAnnees', 'percentages'));
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
