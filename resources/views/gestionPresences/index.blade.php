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
                        <th>Nom/Prenom </th>
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
                        <td>{{$h->employes->nom}}<br>
                            {{$h->employes->prenom}}
                        </td>
                        <td>{{$h->heur_debit}}</td>
                        <td>{{$h->heur_fin}}</td>
                        <td>
                            <button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg></button>
                            <button class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/></svg></button>
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
                    <h5 class="modal-title" id="addEmployeeModalLabel">Ajouter un employé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <label for="dep_id" class="form-label">Employes id</label>
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
                        <label for="heur_debit" class="form-label">Heur debut</label>
                        <input type="time" class="form-control" id="heur_debit" name="heur_debit" required>
                        <x-input-error :messages="$errors->get('heur_debit')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="heur_fin" class="form-label">Heur fin</label>
                        <input type="time" class="form-control" id="heur_fin" name="heur_fin" required>
                        <x-input-error :messages="$errors->get('heur_fin')" class="mt-2" />
                </div>
           
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection