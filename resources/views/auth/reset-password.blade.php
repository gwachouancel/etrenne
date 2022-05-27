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
  <link rel="stylesheet" href="/css/horizontal-layout/style_demogroup.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/favicon_demogroup.jpg" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="/images/Orabank_Logo_RVB.jpeg" alt="logo">
              </div>
              <h4>Bienvenue, {{$user->fullname}}</h4>
              <form class="pt-3" method="POST" id="form" action="{{route('password.update')}}">
                @csrf
                <input type="hidden" name="token" value="{{$request->route('token')}}" />
                <input type="hidden" name="email" value="{{$request->email}}" />
                <div class="form-group">
                  <label for="exampleInputEmail">Définissez un nouveau mot de passe</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="12 caractères minimum">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Confirmer votre mot de passe</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password_confirmation" name="password_confirmation" placeholder="Confirmation de Mot de passe">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                </div>
                <div class="my-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn link-white-ora" type="submit">Suivant</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Vous avez un compte ? <a href="{{route('login')}}" class="text-primary">Connectez-vous</a>
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
  <script src="/js/app.js"></script>
  @include('partials.messages')
  
  <script>
    $("#form").validate({
        rules:{
            password: {
                required: !0,
            },
            password_confirmation: {
                required: !0,
                equalTo: "#password"
            }
        },
        messages:{
            password: {
                required: "{{__('validation.required',['attribute' =>__('common.password')])}}",
            },
            password_confirmation: {
                required: "{{__('validation.required',['attribute' =>__('common.confirm-password')])}}",
                equalTo: "{{__('validation.same',['attribute' =>__('common.confirm-password'),'other' =>__('holder.password')])}}"
            }
        },
      errorPlacement: function(label, e) {
        label.addClass('mt-2 text-danger');
        "checkbox" === e.prop("type") ? label.insertAfter(e.parent("label").parent()) : label.insertAfter(e);
      },
      highlight: function(e, i, n) {
        $(e).parent().addClass('has-danger')
        $(e).addClass('form-control-danger')
      },
      unhighlight: function(e, i, n) {
          $(e).parent().removeClass('has-danger');
      }
    });

    @if ($errors->any())
      let valid = $("#form").validate();
      //valid.form();
      @foreach ($errors->getMessages() as $key => $value)
          @if( strpos($key, 'menu') === false )
            valid.showErrors({"{{$key}}": "{{$value[0]}}"});
          @else
            valid.showErrors({"menus[]": "{{$value[0]}}"});
          @endif
      @endforeach
    @endif
  </script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
