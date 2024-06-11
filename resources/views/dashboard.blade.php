@extends('layouts.master')

@section('contenu')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
  {{-- <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
      <svg class="bi"><use xlink:href="#calendar3"/></svg>
      This week
    </button>
  </div> --}}
</div>
<div class="col-xl-12">
  <div class="card p-3 mb-3 border-bottom d-flex flex-column flex-shrink-3 p-3 bg-body-tertiary" >
      <div class="card-body">
        <div class="row">
          <div class="col-6">
          <h4 class="card-title">Table d'affichage</h4>
          </div>
          <div class="col" align=right>
          <button type="button" class="btn btn-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"></path>
            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"></path>
            </svg>
          </button>
          </div>
        </div>
                      
          <div id="carouselExampleCaption" class="carousel slide mt-2" data-bs-ride="carousel">
              <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active" >
                      <img src="{{asset('img/Artboard 4.png')}}" alt="..." class="d-block img-fluid">
                      <div class="carousel-caption d-none d-md-block text-white-50">
                          <h3 class="text-white">Annoce</h3>
                          <p>nouvel recretemnet.</p>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img src="{{asset('img/conge.png')}}" alt="..." class="d-block img-fluid">
                      <div class="carousel-caption d-none d-md-block text-white-50">
                          <h3 class="text-white">Second slide label</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img src="{{asset('img/Artboard 4.png')}}" alt="..." class="d-block img-fluid">
                      <div class="carousel-caption d-none d-md-block text-white-50">
                          <h3 class="text-white">Third slide label</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                  </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
              </a>
          </div>
      </div>
  </div>
</div> <!-- end col -->
<div class="row">
<div class="col-4 mt-3">
  <div class="card text-white mb-3" style="height: 8rem; background-color: #712CF9;">
    {{-- <div class="card-header">Header</div> --}}
    <div class="card-body">
      <div class="row">
      <div class="col-7">
      <h5 class="card-title">Mon performance</h5>
      <?php
      use App\Models\Employes;
      use App\Models\User;
      use Illuminate\Support\Facades\Auth;

      $id = Auth::user()->id;
      $employes = Employes::where('user_id', $id)->first();
      ?>
      @if (Auth::check() && (Auth::user()->role != 'admin' ))
      <a href='{{ route('HoraireTravails.show', $employes->id) }}'" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Plus d'info <i class="fa fa-arrow-circle-right"></i></a> 
      @endif
      </div>
      <div class="col">
        <img src="{{asset('img/monperf.png')}}" width="100%">
      </div>
      </div>
    </div>
  </div>
</div>
<div class="col mt-3">
  <div class="card card p-3 mb-3 border-bottom d-flex flex-column flex-shrink-3 p-3 bg-body-tertiary" style="height: 8rem;">
    {{-- <div class="card-header">Header</div> --}}
    <div class="card-body">
      <h5 class="card-title">Mon compte</h5>
      <div class="row">
        <div class="col">
              <button class="btn btn-bd-primary py-2 d-flex" style="width: 9rem" align=center onclick="window.location.href='{{ route('cv.showme', $employes->id) }}'">
                CV
              </button>
        </div>
        <div class="col">
              <button class="btn btn-bd-primary py-2 d-flex" style="width: 9rem" align=center>
                SALAIRE
              </button>
        </div>
        <div class="col">
              <button class="btn btn-bd-primary py-2 d-flex" style="width: 9rem" align=center>
                Contrat
              </button>
        </div>
      </div>
      </div>
  </div>
</div>
</div>
@if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'))
<div class="row">
  <div class="col mt-3">
    <div class="card text-white mb-3" style="height: 10rem; background-color: #FFCC66;">
      {{-- <div class="card-header">Header</div> --}}
      <div class="card-body">
        <img src="{{asset('img/employeInfo.png')}}" align=center width="30%">
        <h5 class="card-title">Gestion de personnels</h5>
        <a href="{{route('employes.index')}}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Plus d'info <i class="fa fa-arrow-circle-right"></i></a> 
      </div>
    </div>
  </div>
  <div class="col mt-3">
    <div class="card text-white mb-3" style="height: 10rem; background-color: #FFCC66;">
      {{-- <div class="card-header">Header</div> --}}
      <div class="card-body">
        <img src="{{asset('img/presence.png')}}" align=center width="30%">
        <h5 class="card-title">Gestion de presences</h5>
        <a href="{{route('HoraireTravails.index')}}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Plus d'info <i class="fa fa-arrow-circle-right"></i></a> 
      </div>
    </div>
  </div>
  <div class="col mt-3">
    <div class="card text-white mb-3" style="height: 10rem; background-color: #FFCC66;">
      {{-- <div class="card-header">Header</div> --}}
      <div class="card-body">
        <img src="{{asset('img/congeicon.png')}}" align=center width="30%">
        <br><p></p>
        <h5 class="card-title">Gestion de conges</h5>
        <a href="{{route('conges.index')}}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Plus d'info <i class="fa fa-arrow-circle-right"></i></a> 
        </div>
      </div>
  </div>
  <div class="col mt-3">
    <div class="card text-white mb-3" style="height: 10rem; background-color: #FFCC66;">
      {{-- <div class="card-header">Header</div> --}}
      <div class="card-body">
        <img src="{{asset('img/performance.png')}}" align=center width="30%">
        <h5 class="card-title">Gestion de performance</h5>
        <a href="{{route('evaliations.index')}}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Plus d'info <i class="fa fa-arrow-circle-right"></i></a> 
        </div>
      </div>
    </div>
  </div>
  @endif
  <br><br><br><br>





{{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

<h2>Section title</h2>
<div class="table-responsive small">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1,001</td>
        <td>random</td>
        <td>data</td>
        <td>placeholder</td>
        <td>text</td>
      </tr>
      <tr>
        <td>1,002</td>
        <td>placeholder</td>
        <td>irrelevant</td>
        <td>visual</td>
        <td>layout</td>
      </tr>
      <tr>
        <td>1,003</td>
        <td>data</td>
        <td>rich</td>
        <td>dashboard</td>
        <td>tabular</td>
      </tr>
      <tr>
        <td>1,003</td>
        <td>information</td>
        <td>placeholder</td>
        <td>illustrative</td>
        <td>data</td>
      </tr>
      <tr>
        <td>1,004</td>
        <td>text</td>
        <td>random</td>
        <td>layout</td>
        <td>dashboard</td>
      </tr>
      <tr>
        <td>1,005</td>
        <td>dashboard</td>
        <td>irrelevant</td>
        <td>text</td>
        <td>placeholder</td>
      </tr>
      <tr>
        <td>1,006</td>
        <td>dashboard</td>
        <td>illustrative</td>
        <td>rich</td>
        <td>data</td>
      </tr>
      <tr>
        <td>1,007</td>
        <td>placeholder</td>
        <td>tabular</td>
        <td>information</td>
        <td>irrelevant</td>
      </tr>
      <tr>
        <td>1,008</td>
        <td>random</td>
        <td>data</td>
        <td>placeholder</td>
        <td>text</td>
      </tr>
      <tr>
        <td>1,009</td>
        <td>placeholder</td>
        <td>irrelevant</td>
        <td>visual</td>
        <td>layout</td>
      </tr>
      <tr>
        <td>1,010</td>
        <td>data</td>
        <td>rich</td>
        <td>dashboard</td>
        <td>tabular</td>
      </tr>
      <tr>
        <td>1,011</td>
        <td>information</td>
        <td>placeholder</td>
        <td>illustrative</td>
        <td>data</td>
      </tr>
      <tr>
        <td>1,012</td>
        <td>text</td>
        <td>placeholder</td>
        <td>layout</td>
        <td>dashboard</td>
      </tr>
      <tr>
        <td>1,013</td>
        <td>dashboard</td>
        <td>irrelevant</td>
        <td>text</td>
        <td>visual</td>
      </tr>
      <tr>
        <td>1,014</td>
        <td>dashboard</td>
        <td>illustrative</td>
        <td>rich</td>
        <td>data</td>
      </tr>
      <tr>
        <td>1,015</td>
        <td>random</td>
        <td>tabular</td>
        <td>information</td>
        <td>text</td>
      </tr>
    </tbody>
  </table>
</div> --}}
@endsection
