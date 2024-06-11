@extends('layouts.master')
@section ('contenu')
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div> 
    @endif
    @if (session('faild'))
    <div class="alert alert-danger" role="alert">
        {{ session('faild') }}
    </div> 
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card" id="printableArea" style="padding: 30px;">
                <div class="card-body" >

                    <div class="row" >
                        <div class="col-12">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16"><strong>employe id: {{$Employes->id}}</strong></h4>
                                <h4>
                                <img width="40" align=center src="{{asset('logo/app-logo.jpg')}}">
                                </h4>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $Employes->img_profit)) }}" width="120" height="120">
                                    </address>
                                </div>
                                <div class="col-6 text-end">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <address>
                                        <strong>Nom et prenom : </strong><br>
                                        {{$Employes->nom }} {{$Employes->prenom}}<br>
                                        @if(!empty($Employes->user_id))
                                        {{$Employes->users->email}}
                                        @endif
                                    </address>
                                </div>
                                <div class="col-6 mt-4 text-end">
                                    <address>
                                        <strong>Date d'ampauche:</strong><br>
                                        {{$Employes->created_at->format('Y-m-d')}}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-size-16"><strong>INFORMATION</strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td class="text-end"><strong>valeur</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            <tr>
                                                <td>tel</td>
                                                <td class="text-end">{{$Employes->tel}}</td>
                                            </tr>
                                            <tr>
                                                <td>adresse</td>
                                                <td class="text-end">{{$Employes->adress}}</td>
                                            </tr>
                                            <tr>
                                                <td>role</td>
                                                <td class="text-end">
                                                @if(!empty($Employes->user_id))
                                                    {{$Employes->users->role}}
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>departement</td>
                                                <td class="text-end">{{$Employes->departements->nom}}</td>
                                            </tr>
                                            <tr>
                                                <td>specialite</td>
                                                <td class="text-end">{{$Employes->specialite}}</td>
                                            </tr>
                                            <tr>
                                                <td>diplome</td>
                                                <td class="text-end">{{$Employes->diplome}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <br><br><br><br><br>
                                    </div>

                                    <div class="d-print-none">
                                        <div class="float-end">
                                            <a href="#" class="btn btn-success waves-effect waves-light" onclick="window.print()"><i class="fa fa-print"></i></a>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifEmployeeModal" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
 <br><br><br>
    <div>
    </div>

    <!-- Modal for Adding Employee -->
<div class="modal fade" id="modifEmployeeModal" tabindex="-1" aria-labelledby="modifEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="
            @if (Auth::check() && (Auth::user()->role === 'admin'||Auth::user()->role === 'RRH' ))
            {{ route('cv.set',$Employes->id) }}
             @else
            {{ route('cv.setme',$Employes->id) }}
             @endif
             " method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-header">
                    <h5 class="modal-title" id="modifEmployeeModalLabel">Modifier CV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{$Employes->nom}}" required>
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{$Employes->prenom}}" required>
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                
                    @if (Auth::check() && (Auth::user()->role === 'admin' ||Auth::user()->role === 'RRH'))
                    @if(!empty($Employes->user_id))
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="RRH" {{ $Employes->users->role == 'RRH' ? 'selected' : '' }}>RRH</option>
                            <option value="directeur" {{ $Employes->users->role == 'directeur' ? 'selected' : '' }}>Directeur</option>
                            <option value="employe" {{ $Employes->users->role == 'employe' ? 'selected' : '' }}>Employé</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                    @endif
                    @endif
                    <div class="mb-3">
                        <label for="tel" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel"  value="{{$Employes->tel}}" required>
                        <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adress" name="adress" value="{{$Employes->adress}}" required>
                        <x-input-error :messages="$errors->get('adress')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="diplome" class="form-label">Diplôme</label>
                        <input type="text" class="form-control" id="diplome" name="diplome" value="{{$Employes->diplome}}" required>
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
                        <input type="text" class="form-control" id="specialite" name="specialite"  value="{{$Employes->specialite}}" required>
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
                    <div class="mt-4"> 
                        <label for="specialite" class="form-label">Date d'ambauche</label>
                        <input type="text" class="form-control" id="created_at" name="created_at"  value="{{$Employes->created_at->format('Y-m-d')}}" required>
                        <x-input-error :messages="$errors->get('created_at')" class="mt-2" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </div>
           
            </form>
        </div>
    </div>
</div>
@endsection
