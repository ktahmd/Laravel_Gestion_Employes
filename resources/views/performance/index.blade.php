@extends('layouts.master')
@section('contenu')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01"><svg class="bi"><use xlink:href="#table"/></svg></label>
                <select class="form-select" id="inputGroupSelect01">
                  <option selected>This mounth</option>
                  <option value="1">01/2024</option>
                  <option value="2">02/2024</option>
                  <option value="3">03/2024</option>
                </select>
              </div>
        
        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 75%">75%</div>
          </div>
          <p class="">pressence : 170h </p>
          <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-warning text-dark" style="width: 10%">10%</div>
          </div>
          <p class="">heurs supplimentaire: 27h </p>
          <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger" style="width: 1.5%">1.5%</div>
          </div>
          <p class="">abssence: 3h </p>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row mt-4 ">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tables de presences</h4>
                {{-- <p class="card-title-desc">The Buttons 
                </p> --}}
                
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>HD</th>
                        <th>HF</th>
                        <th>HN</th>
                        <th>HS</th>
                        <th>HA</th>
                        <th>total HT</th>
                    </tr>
                    </thead>

                    
                    <tbody>
                        @foreach($horaires as $h)
                        <tr>
                            <td>{{$h->date_jour}}</td>
                            <td>{{$h->heur_debit}}</td>
                            <td>{{$h->heur_fin}}</td>
                            <td>
                                <?php
                                // Convertir les heures en format de date
                                $HD = new DateTime($h->heur_debit);
                                $HF = new DateTime($h->heur_fin);
                        
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
                                $HN = $interval->format('%H:%I');
                        
                                echo $HN;
                                ?>
                            </td>
                            <td>
                                <?php
                                // Calculer les heures supplémentaires (HS)
                                $HSDeb = new DateTime($h->heur_debit);
                                $HSFin = new DateTime($h->heur_fin);
                                $HS = 0;
                        
                                if ($HSDeb < $HND) {
                                    $intervalHS1 = $HSDeb->diff($HND);
                                    $HS += $intervalHS1->h + ($intervalHS1->i / 60);
                                }
                        
                                if ($HSFin > $HNF) {
                                    $intervalHS2 = $HNF->diff($HSFin);
                                    $HS += $intervalHS2->h + ($intervalHS2->i / 60);
                                }
                        
                                echo sprintf('%02d:%02d', (int)$HS, ($HS - (int)$HS) * 60);
                                ?>
                            </td>
                            <td>
                                <?php
                                // Calculer les heures d'absence (HA)
                                $HHN = new DateTime('08:00');
                                $HHA = $HHN->diff($HD);
                                $HA = 9 - ($interval->h + ($interval->i / 60)); // 9 heures de travail normal - heures normales travaillées
                        
                                echo sprintf('%02d:%02d', (int)$HA, ($HA - (int)$HA) * 60);
                                ?>
                            </td>
                            <td>
                                <?php
                                // Calculer le total des heures supplémentaires (HS) et heures normales (HN)
                                $total = $HS + ($interval->h + ($interval->i / 60));
                                echo sprintf('%02d:%02d', (int)$total, ($total - (int)$total) * 60);
                                ?>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<br><br>
<div></div>
@endsection