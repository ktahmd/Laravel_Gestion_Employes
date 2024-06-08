@extends('layouts.master')
@section('contenu')
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Employes Info</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Data Tables</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Buttons Example</h4>
                                        <p class="card-title-desc">The Buttons extension for DataTables
                                            provides a common set of options, API methods and styling to display
                                            buttons on a page that will interact with a DataTable. The core library
                                            provides the based framework upon which plug-ins can built.
                                        </p>
                                        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>img_profil</th> 
                                                <th>nom et prenom</th>
                                                <th>role</th>
                                                <th>departement</th>
                                                <th>status</th>
                                                <th>action</th>
                                                  
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                                @foreach ($employes as $Employe)
                                            <tr>
<<<<<<< HEAD
                                                <td>{{$Employe->user_id}}</td>
                                                <td>{{$Employe->img_profil}}</td>
                                                <td>{{$Employe->nom}}  {{$Employe->prenom}}</td>
                                                <td>NA</td>
                                                <td>NA</td>
                                                <td>NA</td>
                                               
                                                
                                                <td><button class="btn btn-warning">Modifier</button>
                                                <button class="btn btn-danger">Supprimer</button></td>
                                            </tr>
                                            @endforeach
=======
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
>>>>>>> 9ce152aa8dddd236150be2fe141f92a08f2ecb10
                                            </tbody>
                                            @endsection
                                        </table>
                                       
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        <!-- end row-->
