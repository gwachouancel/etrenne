
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  <link rel="shortcut icon" href="/images/favicon_oragroup.jpg" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="/images/Orabank_Logo_RVB.png" alt="logo">
              </div>
              <h4>Veuillez vous connecter</h4>
              <form class="pt-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input class="form-control form-control-lg border-left-0" id="email" type="email" name="email" value="{{old('email')}}" required autofocus placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Mot de passe</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password"
                                name="password"
                                required autocomplete="current-password" placeholder="Mot de passe">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
                  <a href="#" data-toggle="modal" data-target="#reset" class="auth-link text-black">Mot de passe oublié ?</a>
                </div>
                <div class="my-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn link-white-ora" href="#">Connexion</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Vous n'avez pas de compte ? <a href="#" data-toggle="modal" data-target="#contact" data-whatever="demogroup" class="text-primary">Contactez demogroup</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2022  Tous droits reservés.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Contactez </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="msgfrm" action="{{route('contact')}}">
            @csrf
            <div class="form-group">
              <label for="message-text" class="col-form-label">Votre Message</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="$('#msgfrm').submit()">Envoyer</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Reinitialisez votre mot de passe </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('password.email')}}" method="post" id="resetfrm">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Votre email</label>
              <input type="email" class="form-control" name="email">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="$('#resetfrm').submit()">Envoyer</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
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
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script src="/js/app.js"></script>
  <script>
    (function($) {
    'use strict';
    $('#contact').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('Contactez ' + recipient)
      });
    $('#reset').on('show.bs.modal', function(event) {
      });
    })(jQuery);
  </script>
  @include('partials.messages')
</body>

</html>
