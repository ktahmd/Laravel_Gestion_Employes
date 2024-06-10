@extends('layouts.master')
@section('contenu')
<div class="row">
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('HoraireTravails.show', $id) }}">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01"><svg class="bi"><use xlink:href="#table"/></svg></label>
                    <select class="form-select" name="month" id="inputGroupSelect01">
                        <option selected>choisir mois</option>
                        @foreach($moisAnnees as $M)
                            <option value="{{ $M }}">{{ $M }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5"/>
                          </svg>
                    </button>
                    
                </div>
            </form>
            
            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success" style="width: {{ $percentages['presence'] }}%">{{ $percentages['presence'] }}%</div>
            </div>
            <p>Presence: {{ $percentages['totalPresence'] }}</p>
        
            <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning text-dark" style="width: {{ $percentages['extra'] }}%">{{ $percentages['extra'] }}%</div>
            </div>
            <p>Extra hours: {{ $percentages['totalExtra'] }}</p>
        
            <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-danger" style="width: {{ $percentages['absence'] }}%">{{ $percentages['absence'] }}%</div>
            </div>
            <p>Absence: {{ $percentages['totalAbsence'] }}</p>
            <br>
            <h5>Performace pour la mois : </h5>
            <p>
                @if(empty($selectedMonth))
                aucun mois selectionnee
                @else
                {{$selectedMonth}}
                @endif
            </p>
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
                @php
                function getFrenchDayName($date) {
                    $days = [
                        'Sunday' => 'Dimanche',
                        'Monday' => 'Lundi',
                        'Tuesday' => 'Mardi',
                        'Wednesday' => 'Mercredi',
                        'Thursday' => 'Jeudi',
                        'Friday' => 'Vendredi',
                        'Saturday' => 'Samedi',
                    ];
                    
                    $dayName = $date->format('l'); // Get the day name in English
                    return $days[$dayName]; // Return the day name in French
                }
                @endphp
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>jour</th>
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
                        @if($h->heur_debit === '00:00:00' && $h->heur_fin === '00:00:00' &&  $h->HA != 0) 
                        <tr>
                            <td style="background-color: rgb(252, 209, 209)">{{ getFrenchDayName(new DateTime($h->date_jour)) }}</td>
                            <td  style="background-color: rgb(252, 209, 209)">{{ $h->date_jour }}</td>
                            <td style="background-color: rgb(252, 209, 209)">N/A</td>
                            <td style="background-color: rgb(252, 209, 209)">N/A</td>
                            <td style="background-color: rgb(252, 209, 209)">
                                @php
                                $HN = $h->HN;
                                echo sprintf('%02d:%02d', (int)$HN, ($HN - (int)$HN) * 60);
                                @endphp
                            </td>
                            <td style="background-color: rgb(252, 209, 209)">
                                @php
                                $HS = $h->HS;
                                echo sprintf('%02d:%02d', (int)$HS, ($HS - (int)$HS) * 60);
                                @endphp
                            </td>
                            <td style="background-color: rgb(252, 209, 209)">
                                @php
                                $HA = $h->HA;
                                echo sprintf('%02d:%02d', (int)$HA, ($HA - (int)$HA) * 60);
                                @endphp
                            </td style="background-color: rgb(252, 209, 209)">
                            <td style="background-color: rgb(252, 209, 209)">
                                @php
                                $total = $HS + $HN;
                                echo sprintf('%02d:%02d', (int)$total, ($total - (int)$total) * 60);
                                @endphp
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ getFrenchDayName(new DateTime($h->date_jour)) }}</td>
                            <td>{{ $h->date_jour }}</td>
                            <td>{{ $h->heur_debit }}</td>
                            <td>{{ $h->heur_fin }}</td>
                            <td>
                                @php
                                $HN = $h->HN;
                                echo sprintf('%02d:%02d', (int)$HN, ($HN - (int)$HN) * 60);
                                @endphp
                            </td>
                            <td>
                                @php
                                $HS = $h->HS;
                                echo sprintf('%02d:%02d', (int)$HS, ($HS - (int)$HS) * 60);
                                @endphp
                            </td>
                            
                            <td style="{{ ($h->HA != 0) ? 'background-color: rgb(252, 209, 209);' : '' }}">
                                @php
                                $HA = $h->HA;
                                echo sprintf('%02d:%02d', (int)$HA, ($HA - (int)$HA) * 60);
                                @endphp
                            </td>
                           
                            <td>
                                @php
                                $total = $HS + $HN;
                                echo sprintf('%02d:%02d', (int)$total, ($total - (int)$total) * 60);
                                @endphp
                            </td>
                        </tr>

                        @endif
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