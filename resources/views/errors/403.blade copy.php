
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acces Refusé</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/favicon_demogroup.jpg" />
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
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
                  @php 
                    $user = auth()->user(); 
                    $route = $user ? route($user->role.'.dashboard') : route('login'); 
                  @endphp
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
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <script src="/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/js/off-canvas.js"></script>
  <script src="/js/hoverable-collapse.js"></script>
  <script src="/js/template.js"></script>
  <script src="/js/settings.js"></script>
  <script src="/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
