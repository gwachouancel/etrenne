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
  <link rel="stylesheet" href="/css/horizontal-layout/style_oragroup.css">
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
@php $user =  auth()->user();
$batPerm = $user->hasMenu('user.bats');
$orderPerm = $user->hasMenu('user.orders');
$expeditionPerm = $user->hasMenu('admin.documents.expeditions');
$billPerm = $user->hasMenu('user.all.bills');

$accountperm = $user->hasMenu('admin.accounts');
$filialePerm = $user->hasMenu('admin.filiales');
$directionPerm = $user->hasMenu('admin.directions');
$closePerm = $user->hasMenu('admin.setting.close');
$docPerm = $user->hasMenu('admin.setting.document');
$delayPerm = $user->hasMenu('admin.setting.delay');
$currencyPerm = $user->hasMenu('admin.setting.currency');
$supplierFilePerm = $user->hasMenu('admin.supplier.display');

@endphp
<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper navbar-brand-wrapper-ora d-flex align-items-center justify-content-center">
            <a class="navbar-brand navbar-brand-ora brand-logo"href="{{route('admin.dashboard')}}"><img src="/images/Orabank_Logo_RVB.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><img src="/images/ora-mini.jpg" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">        
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">
                {{$user->name .'-'. $user->filialename}}
              </li>              
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  <img src="/images/profile_s.png" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="{{route('admin.profile')}}">
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
              <a class="nav-link" href="{{route($user->role.'.dashboard')}}">
                <i class="mdi mdi-home-outline menu-icon"></i>
                <span class="menu-title">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-item">
              @if( $user->hasMenu('admin.marketplace') )
              <a class="nav-link" href="{{ route('admin.marketplace') }}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Espace market</span>
              </a>
              @endif
            </li>
            <li class="nav-item">
              @if( $orderPerm || $batPerm || $supplierFilePerm )
                <a class="nav-link" href="#">
                  <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                  <span class="menu-title">Commandes</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                      @if( $orderPerm )
                      <li class="nav-item"><a class="nav-link" href="{{ route($user->role.'.orders') }}">Commandes</a></li>
                      @endif
                      @if( $batPerm )
                      <li class="nav-item"><a class="nav-link" href="{{ route($user->role.'.bats') }}">BAT</a></li>
                      @endif
                      @if( $supplierFilePerm )
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin.supplier.display') }}">Fiches Fournisseurs</a></li>
                      @endif
                  </ul>
                </div>
                @endif
              </li>
            <li class="nav-item">
              @if( $billPerm || $expeditionPerm )
              <a href="#" class="nav-link">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documents</span>
                <i class="menu-arrow"></i>
                </a> 
                <div class="submenu">
                  <ul class="submenu-item">
                      @if( $billPerm )
                      <li class="nav-item"><a class="nav-link" href="{{route($user->role.'.all.bills')}}">Factures</a></li>
                      @endif
                      @if( $expeditionPerm )
                      <li class="nav-item"><a class="nav-link" href="{{route($user->role.'.documents.expeditions')}}">Expéditions</a></li>
                      @endif
                    </ul>
                </div>   
                @endif          
            </li>
            <li class="nav-item">
              @if( $accountperm || $filialePerm || $directionPerm || $closePerm || $delayPerm || $currencyPerm || $docPerm)
              <a href="#" class="nav-link">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Configurations</span>
                <i class="menu-arrow"></i>
                </a>  
                <div class="submenu">
                @php
                  if(App\Models\Setting::where('slug','platform')->first()->data)
                      $closeText = __('admin/navigation.close_app');
                  else
                      $closeText = __('admin/navigation.open_app');
                @endphp
                  <ul class="submenu-item">
                      @if($accountperm)<li class="nav-item"><a class="nav-link" href="{{route('admin.accounts')}}">{{__('menus.account')}}</a></li>@endif
                      @if($filialePerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.filiales')}}">{{__('admin/navigation.filiales')}}</a></li>@endif
                      @if($directionPerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.directions')}}">{{__('admin/navigation.directions')}}</a></li>@endif
                      @if($closePerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.setting.close')}}">{{$closeText}}</a></li>@endif
                      @if($docPerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.setting.document')}}">{{__('admin/setting.document_title')}}</a></li>@endif
                      @if($delayPerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.setting.delay')}}">{{__('admin/navigation.delay')}}</a></li>@endif
                      @if($currencyPerm)<li class="nav-item"><a class="nav-link" href="{{route('admin.setting.currency')}}">{{__('admin/navigation.currency')}}</a></li>@endif
                  </ul>
                </div>  
                @endif          
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
  <script src="/js/tablesorter.js?v=1.2"></script>
  <script src="/js/data-table.js"></script>

  <!-- End custom js for this page-->
  <script src="/js/app.js"></script>
  @include('partials.messages')
  @yield('scripts')
</body>

</html>