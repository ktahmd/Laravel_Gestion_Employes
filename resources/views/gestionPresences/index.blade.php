@extends('layouts.master')
@section('contenu')
<!-- start page title -->
@if(session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
@if(session('faild'))
<div class="alert alert-danger" role="alert">
    {{session('faild')}}
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Presences Info</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                Ajouter horaire
                            </button>
                        </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row ">
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
                            <th>id employe</th>
                            <th>Nom/Prenom</th>
                            <th>Heurs debut</th>
                            <th>Heurs fin</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horaires as $h)
                        
                        <tr>
                            <td>{{$h->date_jour}}</td>
                            <td>{{$h->employe_id}}</td>
                            <td>
                                {{$h->employes->nom}}<br>{{$h->employes->prenom}}
                            </td>
                            @if($h->heur_debit === '00:00:00' && $h->heur_fin === '00:00:00') 
                            <td>N/A</td>
                            <td>N/A</td>
                            @else
                            <td>{{$h->heur_debit}}</td>
                            <td>{{$h->heur_fin}}</td>
                            @endif
                            <td>
                                <div class="row">
                                <div class="col">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </button>
                                
                                                <!-- Modal for Adding Employee -->
                                                <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('HoraireTravails.update', $h->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editEmployeeModalLabel">modifer horaire</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mt-4">
                                                                        <input type="hidden" class="form-control" id="id_MOD" name="id_MOD" value="{{$h->id}}" required>
                                                                        <input type="hidden" class="form-control" id="employe_id_MOD" name="employe_id_MOD" value="{{$h->employe_id}}" required>
                                                                        <input type="hidden" class="form-control" id="date_jour_MOD" name="date_jour_MOD" value="{{$h->date_jour}}" required>
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Employé monté</label><br>
                                                                        <input type="radio" id="monte_oui_MOD" name="employe_monte_MOD" value="oui" checked>
                                                                        <label for="monte_oui_MOD">Oui</label>
                                                                        <input type="radio" id="monte_non_MOD" name="employe_monte_MOD" value="non">
                                                                        <label for="monte_non_MOD">Non</label>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="heur_debit_MOD" class="form-label" >Heur debut</label>
                                                                        <input type="text" class="form-control time-input" id="heur_debit_MOD" name="heur_debit_MOD" value="{{ substr($h->heur_debit, 0, 5) }}" pattern="^(?:[01][0-9]|2[0-3]):[0-5][0-9]$" title="Format attendu : HH:MM">
                                                                        <x-input-error :messages="$errors->get('heur_debit')" class="mt-2" />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="heur_fin_MOD" class="form-label">Heur fin</label>
                                                                        <input type="text" class="form-control time-input" id="heur_fin_MOD" name="heur_fin_MOD" value ="{{substr($h->heur_fin, 0, 5)}}" required pattern="^(?:[01][0-9]|2[0-3]):[0-5][0-9]$" title="Format attendu : HH:MM">
                                                                        <x-input-error :messages="$errors->get('heur_fin')" class="mt-2" />
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                    <button type="submit" class="btn btn-primary">save</button>
                                                                </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                <div class="col">
                                <form method="POST" action="{{ route('HoraireTravails.destroy', $h->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                                </div>
                                </div>
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

<!-- Modal for Adding Employee -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('HoraireTravails.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Ajouter horaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <label for="employe_id" class="form-label">Employes id</label>
                        {!! Form::select(
                            'employe_id', 
                            App\Models\Employes::pluck('id','id'), 
                            null, 
                            [
                                'class' => 'block mt-1 form-select', 
                                'placeholder' => '-- Choisir id --', 
                                'id' => 'employe_id',
                                'required', 
                            ]
                        ) !!}
                        <x-input-error :messages="$errors->get('employe_id')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="date_jour" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_jour" name="date_jour" required>
                        <x-input-error :messages="$errors->get('date_jour')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employé monté</label><br>
                        <input type="radio" id="monte_oui" name="employe_monte" value="oui" checked>
                        <label for="monte_oui">Oui</label>
                        <input type="radio" id="monte_non" name="employe_monte" value="non">
                        <label for="monte_non">Non</label>
                    </div>
                    <div class="mb-3">
                        <label for="heur_debit" class="form-label">Heur debut</label>
                        <input type="text" class="form-control time-input" id="heur_debit" name="heur_debit" required pattern="^(?:[01][0-9]|2[0-3]):[0-5][0-9]$" title="Format attendu : HH:MM">
                        <x-input-error :messages="$errors->get('heur_debit')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="heur_fin" class="form-label">Heur fin</label>
                        <input type="text" class="form-control time-input" id="heur_fin" name="heur_fin" required pattern="^(?:[01][0-9]|2[0-3]):[0-5][0-9]$" title="Format attendu : HH:MM">
                        <x-input-error :messages="$errors->get('heur_fin')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </div>
           
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the radio buttons and the related fields
        const monteOui = document.getElementById("monte_oui");
        const monteNon = document.getElementById("monte_non");
        const heurDebitField = document.getElementById("heur_debit");
        const heurFinField = document.getElementById("heur_fin");

        // Function to show or hide fields based on radio button selection
        function toggleFields() {
            if (monteOui.checked) {
                // Show the fields and remove the 'disabled' attribute
                heurDebitField.removeAttribute("disabled");
                heurFinField.removeAttribute("disabled");
            } else if (monteNon.checked) {
                // Hide the fields and set their values to '00:00'
                heurDebitField.setAttribute("disabled", true);
                heurFinField.setAttribute("disabled", true);
                heurDebitField.value = "00:00";
                heurFinField.value = "00:00";
            }
        }

        // Call the function initially to set the initial state
        toggleFields();

        // Add event listeners to the radio buttons to call the function when they are clicked
        monteOui.addEventListener("change", toggleFields);
        monteNon.addEventListener("change", toggleFields);

        // Get the radio buttons and the related fields
        const monteOui_MOD = document.getElementById("monte_oui_MOD");
        const monteNon_MOD = document.getElementById("monte_non_MOD");
        const heurDebitField_MOD = document.getElementById("heur_debit_MOD");
        const heurFinField_MOD = document.getElementById("heur_fin_MOD");

        // Function to show or hide fields based on radio button selection
        function toggleFields_MOD() {
            if (monteOui_MOD.checked) {
                // Show the fields and remove the 'disabled' attribute
                heurDebitField_MOD.removeAttribute("disabled");
                heurFinField_MOD.removeAttribute("disabled");
            } else if (monteNon_MOD.checked) {
                // Hide the fields and set their values to '00:00'
                heurDebitField_MOD.setAttribute("disabled", true);
                heurFinField_MOD.setAttribute("disabled", true);
                heurDebitField_MOD.value = "00:00";
                heurFinField_MOD.value = "00:00";
            }
        }

        // Call the function initially to set the initial state
        toggleFields_MOD();

        // Add event listeners to the radio buttons to call the function when they are clicked
        monteOui_MOD.addEventListener("change", toggleFields_MOD);
        monteNon_MOD.addEventListener("change", toggleFields_MOD);
    });
</script>




@endsection