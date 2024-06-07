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
        {{-- SEARCH BAR --}}
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

      {{-- MESSAGES --}}
      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
              data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="ri-notification-3-line" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
              </svg>
            <span class="noti-dot"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> Messages </h6>
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">
                <a href="" class="text-reset notification-item">
                    <div class="d-flex">
                        <div class="avatar-xs me-3">
                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                <i class="ri-shopping-cart-line"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <h6 class="mb-1">mohamed</h6>
                            <div class="font-size-12 text-muted">
                                {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p> --}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="p-2 border-top">
                <div class="d-grid">
                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                    </a>
                </div>
            </div>
        </div>
    </div>
            {{-- NOTIFICATION --}}
            <div class="dropdown d-inline-block">
              <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="ri-notification-3-line" viewBox="0 0 16 16">
                      <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                    </svg>
                  <span class="noti-dot"></span>
              </button>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                  aria-labelledby="page-header-notifications-dropdown">
                  <div class="p-3">
                      <div class="row align-items-center">
                          <div class="col">
                              <h6 class="m-0"> Notifications </h6>
                          </div>
                      </div>
                  </div>
                  <div data-simplebar style="max-height: 230px;">
                      <a href="" class="text-reset notification-item">
                          <div class="d-flex">
                              <div class="avatar-xs me-3">
                                  <span class="avatar-title bg-primary rounded-circle font-size-16">
                                      <i class="ri-shopping-cart-line"></i>
                                  </span>
                              </div>
                              <div class="flex-1">
                                <h6 class="mb-1">mohamed</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">new registre</p>
                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p> --}}
                                </div>
                            </div>
                          </div>
                      </a>
                  </div>
                  <div class="p-2 border-top">
                      <div class="d-grid">
                          <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                              <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      {{-- USER PAN --}}
        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
            <strong>mdo</strong>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Deconnexion</a></li>

          </ul>
        </div>
      </div>
    </div>
  </header>