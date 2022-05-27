@extends('layouts.supplier')

@section('content')
@php $user = auth()->user(); @endphp
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                <h4 class="card-title"> Mon profil</h4>
                </div>
            </div>
            <br>
            <form class="form-sample" method="post" id="form">
                @csrf
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')??$user->name}}" />
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Prenom</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')??$user->lastname}}"/>
                    </div>
                    </div>
                </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Entreprise</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="company" name="company" value="{{old('company')??$user->companyname}}"/>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')??$user->email}}" />
                            </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Adresse</label>
                    <div class="col-sm-9">
                        <input type="text" id="address" name="address" class="form-control" value="{{old('address')??$user->supplieraddress}}" />
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pays</label>
                    <div class="col-sm-9">
                        <label class="badge badge-secondary form-pos-ora">{{$user->suppliercountry}}</label>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Telephone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone"s value="{{old('phone')??$user->phone}}"/>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Type de produits</label>
                    <div class="col-sm-9">
                        <label class="badge badge-secondary form-pos-ora">{{$user->producttype}}</label>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Statut</label>
                    <div class="col-sm-9">
                        <label class="badge badge-success form-pos-ora">{{__('common.'.$user->status)}}</label>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nouveau mot de passe</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Confirmer le nouveau mot de passe</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-8">
                
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                    <button class="btn btn-light">Annuler</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary mr-2">Sauvegarder</button>
                    </div>
                </div>
                </div>
            
            </form>
            </div>
        </div>
        </div>          
    </div>
  <br>
  <br>
  <br>
</div>
@endsection

@section('scripts')
  <!-- Custom js for this page-->
  <script src="/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>
    $("#form").validate({
      rules: {
        name: "required",
        lastname: "required",
        company: "required",
        email: {
            required : true,
            email : true
        },
        address: "required",
        phone: "required",
        /*password: {
            required: true,
            minlength: 12
        },
        confirm_password: {
            required: true,
            minlength: 12,
            equalTo: "#password"
        }*/
      },
      messages: {
        name: "{{__('validation.required',['attribute'=> 'Nom'])}}",
        lastname: "{{__('validation.required',['attribute'=> 'Prenom'])}}",
        company: "{{__('validation.required',['attribute'=> 'Entreprise'])}}",
        address: "{{__('validation.required',['attribute'=> 'Adresse'])}}",
        phone: "{{__('validation.required',['attribute'=> 'Telephone'])}}",
        email: {
            required : "{{__('validation.required',['attribute'=> __('common.email')])}}",
            email : "{{__('validation.email',['attribute'=>__('common.email')])}}"
        },
        /*password: {
            required: "{{__('validation.required',['attribute' =>__('common.password')])}}",
            //minlength: "Your password must be at least 8 characters long"
        },
        confirm_password: {
                required: "{{__('validation.required',['attribute' =>__('common.confirm-password')])}}",
                equalTo: "{{__('validation.same',['attribute' =>__('common.confirm-password'),'other' =>__('holder.password')])}}"
        },*/
      },
      errorPlacement: function(label, e) {
        label.addClass('mt-2 text-danger');
        "checkbox" === e.prop("type") ? label.insertAfter(e.parent("label")) : label.insertAfter(e);
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
  @endsection