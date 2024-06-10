
<div class="d-flex flex-column flex-shrink-0 p-3" style="width: 250px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link link-body-emphasis" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#house"/></svg>
          Home
        </a>
      </li>
      <li>
        <a href="{{url('/dashboard')}}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{url('/massage')}}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#msg"/></svg>
          Messages
        </a>
      </li>
      <li>
        
        <?php
        use App\Models\Employes;
        use App\Models\User;
        use Illuminate\Support\Facades\Auth;
        
        $id = Auth::user()->id;
        $employess = Employes::where('user_id', $id)->first();
        ?>
        @if (Auth::check() && (Auth::user()->role != 'admin' ))
        <a href="{{ route('HoraireTravails.show', $employess->id) }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#chart"/></svg>
          Mon performance
        </a>
        @endif
      </li>
      @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'|| Auth::user()->role === 'DG'|| Auth::user()->role === 'directeur'))
      <li>
        <a href="
        @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'))
        {{url('/employes')}}
        @endif
        @if (Auth::check() && (Auth::user()->role === 'DG' || Auth::user()->role === 'directeur'))
        {{url('/employeinfo')}}
        @endif
        " 
        class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          Gestion de personnels
        </a>
      </li>
      @endif
      @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'))
      <li>
        <a href="{{route('conges.index')}}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
          Gestion de conges
        </a>
      </li>
    </li>
    <li>
      <a href="{{route('HoraireTravails.index')}}" class="nav-link link-body-emphasis">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
        Gestion de presences
      </a>
    </li>
    </li>
    @endif
    @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'RRH'|| Auth::user()->role === 'DG'|| Auth::user()->role === 'directeur'))
      <li>
        <a href="{{route('evaliations.index')}}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
          Gestion de performance
        </a>
      </li>
    @endif
    </ul>
    
    <hr>
    
    
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        
        <?php
            $id = Auth::user()->id;
            $employe = Employes::where('user_id', $id)->first();

            if (!empty($employe) && !empty($employe->img_profit)) {
                $img = $employe->img_profit;
            } else {
                $img = 'profiles/user.png';
            }
            if (!empty($employe) && !empty($employe->nom)) {
                $nom = $employe->nom;
            } else {
                $nom = Auth::user()->username; 
            }
          ?>
        <img src="{{asset('storage/' . str_replace('public/', '', $img)) }}" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>{{$nom}}</strong>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}">Deconnexion</a></li>
      </ul>

    </div>
  </div>