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
                            <th>Département</th>
                            <th>evaliation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employes as $Employe)
                        <tr>
                            <td>{{$Employe->id}}</td>
                            <td><img src="{{ asset('storage/' . str_replace('public/', '', $Employe->img_profit)) }}" width="50" height="50"></td>
                            <td>{{$Employe->nom}} <br> {{$Employe->prenom}}</td>
                            <td>{{$Employe->departements->nom}}</td>
                            <td>
                                @if(empty($Employe->rating))
                                aucun evalation
                                @else
                                <div class="rating-star" align=center>
                                    <input type="hidden" class="rating" data-filled="mdi mdi-star text-primary" data-empty="mdi mdi-star-outline text-muted" data-readonly value="{{$Employe->rating}}"/>
                                </div>      
                                @endif
                            </td>
                            <td>
                                
                                <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#employeeDetailsModal{{ $Employe->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                  </svg></button>
                                
                                <button class="btn btn-success" onclick="window.location.href='{{ route('HoraireTravails.show', $Employe->id) }}'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                  </svg></button>
                            </td>
                        </tr>
                        </div>
                        <!-- Modal for Employee Details -->
                        <div class="modal fade" id="employeeDetailsModal{{ $Employe->id }}" tabindex="-1" aria-labelledby="employeeDetailsModal{{ $Employe->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('evaliations.set', $Employe->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addEmployeeModalLabel">Évaluation de {{ $Employe->nom }} {{ $Employe->prenom }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $Employe->id }}">
                                            <div class="mb-3">
                                                <label for="taux_eval" class="form-label">Évaluation de performance</label>
                                                    <div class="rating-star"  align=center>
                                                        <input type="hidden" id="rating" name="rating" class="rating" data-filled="mdi mdi-star text-primary" data-empty="mdi mdi-star-outline text-primary" data-fractions="2"/>
                                                    </div>    
                                                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</div>


@endsection
