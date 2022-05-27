<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Demo - Accès refusé</title>
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
  <link rel="shortcut icon" href="/images/favicon_demogroup.jpg" />
</head>
@php 
  $user = auth()->user(); 
  $route = $user ? route($user->role.'.dashboard') : route('login'); 
@endphp
<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper navbar-brand-wrapper-ora d-flex align-items-center justify-content-center">
            <a class="navbar-brand navbar-brand-ora brand-logo"href="{{$route}}"><img src="/images/Orabank_Logo_RVB.jpeg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{$route}}"><img src="/images/ora-mini.png" alt="logo"/></a>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar bottom-navbar-ora" style="box-shadow:none !important;-webkit-box-shadow:none !important;">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a class="nav-link">
                
                <span class="menu-title">&nbsp;</span>
              </a>
            </li>
            <li class="nav-item">
            </li>
            <li class="nav-item">
            </li>
            <li class="nav-item">        
            </li>
            <li class="nav-item">          
            </li>                    
          </ul>
        </div>
      </nav>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
      <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page" style="background-color:#026604 !important;">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">403</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>Désolé!</h2>
                <h3 class="font-weight-light">Vous ne pouvez pas acceder à cette page.</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="{{$route}}">Retour au Tableau de bord</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright © 2022 <a href="http://www.example.com/" target="_blank" class="text-muted">demogroup</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
        <!-- content-wrapper ends -->
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
  <script src="/js/tablesorter.js?v=1.2"></script>
  <script src="/js/data-table.js"></script>

  <!-- End custom js for this page-->
  <script src="/js/app.js"></script>
  @include('partials.messages')
</body>

</html>