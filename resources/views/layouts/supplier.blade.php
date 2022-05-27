<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Demo - demogroup</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/horizontal-layout/style.css">
  <link rel="stylesheet" href="/css/horizontal-layout/style_demogroup.css">
  <!-- endinject -->
  <link rel="stylesheet" href="/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  @yield('styles')
  <style>
    .form-check a{
      text-decoration:none;
      color: inherit;
    }
    label.error{
      color: #fc5661 !important;
    }
  </style>
  <link rel="shortcut icon" href="/images/favicon_demogroup.png" />
</head>
@php $user = auth()->user(); @endphp
<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper navbar-brand-wrapper-ora d-flex align-items-center justify-content-center">
            <a class="navbar-brand navbar-brand-ora brand-logo"href="{{route('supplier.dashboard')}}"><img src="/images/Orabank_Logo_RVB.jpg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{route('supplier.dashboard')}}"><img src="/images/ora-mini.png" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">        
            <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                {{$user->name .' - '. $user->supplier->company}}
              </li>             
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  <img src="/images/profile_s.png" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="{{route('supplier.profile')}}">
                    <i class="mdi mdi-settings text-primary"></i>
                    Mon Profil
                  </a>
                  <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="mdi mdi-logout text-primary"></i>
                    Se déconnecter
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar bottom-navbar-ora">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a class="nav-link" href="{{route('supplier.dashboard')}}">
                <i class="mdi mdi-home-outline menu-icon"></i>
                <span class="menu-title">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('supplier.catalogs')}}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Mes catalogues</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                  <span class="menu-title">Commandes</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="{{route('supplier.orders')}}">Commandes</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{route('supplier.bats')}}">BAT</a></li>
                  </ul>
                </div>
              </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documents</span>
                <i class="menu-arrow"></i>
                </a> 
                <div class="submenu">
                  <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="{{route('supplier.bills')}}">Factures</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{route('supplier.expeditions')}}">Expéditions</a></li>
                  </ul>
                </div>             
            </li>                    
          </ul>
        </div>
      </nav>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022 <a href="http://www.example.com/" target="_blank" class="text-muted">demogroup</a>. Tous droits reservés.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Demo - demogroup</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <script src="/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/js/off-canvas.js"></script>
  <script src="/js/hoverable-collapse.js"></script>
  <script src="/js/template.js"></script>
  <script src="/js/settings.js"></script>
  <script src="/js/todolist.js"></script>
  <script src="/js/jq.tablesort.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/js/dashboard.js"></script>
  <script src="/js/todolist.js"></script>
  <script src="/js/tablesorter.js?v=1.1"></script>
  <script src="/js/data-table.js"></script>

  <!-- End custom js for this page-->
  <script src="/js/app.js"></script>
  @include('partials.messages')
  @yield('scripts')
</body>

</html>