<header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
    <div class="container-fluid">
       <nav class="navbar">
          <!-- start: toggle btn -->
          <div class="d-flex">
             <button type="button" class="btn btn-link d-none d-xl-block sidebar-mini-btn p-0 text-primary">
             <span class="hamburger-icon">
             <span class="line"></span>
             <span class="line"></span>
             <span class="line"></span>
             </span>
             </button>
             <button type="button" class="btn btn-link d-block d-xl-none menu-toggle p-0 text-primary">
             <span class="hamburger-icon">
             <span class="line"></span>
             <span class="line"></span>
             <span class="line"></span>
             </span>
             </button>
          </div>
          <!-- start: link -->
          <ul class="header-right justify-content-end d-flex align-items-center mb-0">
             <li>
                <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                   <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                   <img class="avatar img-thumbnail rounded-circle shadow" src="{{ asset(Storage::url(auth()->user()->getUserProfile())) }}" alt="">
                   </a>
                   <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                      <div class="card border-0 w240">
                         <div class="card-body border-bottom d-flex">
                            <img class="avatar rounded-circle" src="{{ asset(Storage::url(auth()->user()->getUserProfile())) }}" alt="">
                            <div class="flex-fill ms-3">
                               <h6 class="card-title mb-0">{{ auth()->user()->getUserName() }}</h6>
                               <span class="text-muted">{{ Auth::user()->email }}</span>
                            </div>
                         </div>
                         <div class="list-group m-2 mb-3">
                            <a class="list-group-item list-group-item-action border-0" href="page-profile.html"><i class="w30 fa fa-user"></i>{{ __('Profile & account') }}</a>
                            <a class="list-group-item list-group-item-action border-0" href="account-settings.html"><i class="w30 fa fa-gear"></i>{{ __('Settings') }}</a>
                            <a class="list-group-item list-group-item-action border-0" href="page-teamsboard.html"><i class="w30 fa fa-users"></i>{{ __('Manage User') }}</a>
                            <a class="list-group-item list-group-item-action border-0" href="dashboard-enevt.html"><i class="w30 fa fa-calendar"></i>{{ __('My Events') }}</a>
                         </div>
                         <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn bg-secondary text-light text-uppercase rounded-0">{{ __('Logout') }}</a>
                         {!! Form::open(["route" => ["logout"], "style" => "display:none", "method" => "POST", "id" => "logout-form"]) !!}
                         {!! Form::close() !!}
                        </div>
                   </div>
                </div>
             </li>
             <!-- start: Settings toggle modal -->
          </ul>
       </nav>
    </div>
 </header>
