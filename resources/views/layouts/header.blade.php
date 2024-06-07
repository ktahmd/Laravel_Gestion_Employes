<header class="p-3 mb-3 border-bottom d-flex flex-column flex-shrink-3 p-3 bg-body-tertiary">
    <div class="container ">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img class="me-2" width="50" role="img" aria-label="Bootstrap" src="{{asset('logo/app-logo.jpg')}}">

        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Dashbord</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
            <strong>mdo</strong>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route('login')}}">deconnexion</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>