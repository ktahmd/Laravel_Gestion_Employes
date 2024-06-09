@extends('layouts.master')
@section('contenu')
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
<!-- Page Title and Add Button -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Employes Info</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'))
                        <li class="breadcrumb-item active">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                Ajouter employé
                            </button>
                        </li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Employee List Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Employés</h4>
                <p class="card-title-desc"></p>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nom et Prénom</th>
                            <th>Rôle</th>
                            <th>Département</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employes as $Employe)
                        <tr>
                            <td>{{$Employe->id}}</td>
                            <td><img src="{{ asset('storage/' . str_replace('public/', '', $Employe->img_profit)) }}" width="50" height="50"></td>
                            <td>{{$Employe->nom}} <br> {{$Employe->prenom}}</td>
                            <td>
                                @if(empty($Employe->user_id))
                                    employe
                                @else
                                    {{$Employe->users->role}}
                                @endif
                            </td>
                            <td>{{$Employe->departements->nom}}</td>
                            <td>
                                <!-- Button trigger modal for displaying employee details -->
                                <button class="btn btn-success">CV</button>
                                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'))
                                    <button class="btn btn-danger">Supprimer</button>
                                @endif
                            </td>
                        </tr>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Employee -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Ajouter un employé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel" required>
                        <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="diplome" class="form-label">Diplôme</label>
                        <input type="text" class="form-control" id="diplome" name="diplome" required>
                        <x-input-error :messages="$errors->get('diplome')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image de Profil</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                     <!-- specealite -->
         <div class="mt-4"> 
            <label for="specialite" class="form-label">Specialite</label>
            <input type="text" class="form-control" id="specialite" name="specialite" required>
            <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
        </div>
        <!-- depertement -->
        <div class="mt-4">
            <label for="dep_id" class="form-label">Departement</label>
            
            {!! Form::select(
                'dep_id', 
                App\Models\Departements::pluck('nom', 'id'), 
                null, 
                [
                    'class' => 'block mt-1 form-select', 
                    'placeholder' => '-- Choisir Departement --', 
                    'id' => 'dep_id', 
                    'required', 
                    
                ]
            ) !!}
            
            <x-input-error :messages="$errors->get('dep_id')" class="mt-2" />
        </div>

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
