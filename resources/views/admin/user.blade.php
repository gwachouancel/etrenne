@extends('layouts.admin')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        @include('layouts.adminnavigation')
        <div class="col-md-9">
            <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                <div>
                <h4 class="card-title"><a href="{{route('admin.accounts')}}" title=""><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; {{$title}}</h4>
                </div>
                </div>
                <br>
                <form id="form" class="form-sample" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.name')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')??$user->name}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.lastname')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')??$user->lastname}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.category')}}</label>
                            <div class="col-sm-9">
                                @php $role = old('role') ?? $user->role @endphp
                                <select class="form-control" id="role" name="role">
                                    <option value="">{{__('common.choose_a_value')}}</option>
                                    <option {{$role=='admin'?"selected":""}} value="admin">{{__('permission.admin')}}</option>
                                    <option {{$role=='user'?"selected":""}} value="user">{{__('permission.user')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.email')}}</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" placeholder="exemple@email.com" id="email" name="email" value="{{old('email')??$user->email}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.subsidiary')}}</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="filiale_id" name="filiale_id">
                                    <option value="">{{__('common.choose_a_value')}}</option>
                                    @foreach($filiales as $fil)
                                        @if( old('filiale_id')==$fil->id || $user->filialeid == $fil->id )
                                        <option selected="selected" value="{{$fil->id}}">{{$fil->name}}</option>
                                        @else
                                        <option value="{{$fil->id}}">{{$fil->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.status')}}</label>
                            <div class="col-sm-9">
                            @php $status = old('status') ?? $user->status @endphp
                                <select class="form-control" id="status" name="status">
                                    <option {{$status=='active'?"selected":""}} value='active'>{{__('common.active')}}</option>
                                    <option {{$status=='inactive'?"selected":""}} value='inactive'>{{__('common.inactive')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('admin/setting.fonction')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fonction" name="fonction" value="{{old('fonction')??$user->fonction}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.phone')}}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="999 999 999" id="phone" name="phone" value="{{old('phone')??$user->phone}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('common.role')}}</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="permission_id" name="permission_id">
                                    <option value="">{{__('common.choose_a_value')}}</option>
                                    @foreach($permissions as $perm)
                                        @if( old('permission_id')==$perm->id || $user->permission_id == $perm->id )
                                        <option selected="selected" value="{{$perm->id}}">{{$perm->name}}</option>
                                        @else
                                        <option value="{{$perm->id}}">{{$perm->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    
                    </div>
                    <div class="col-md-4">
                    <div class="form-group row">
                        <button type="reset" class="btn btn-light">{{__('common.cancel')}}</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary mr-2">{{__('common.save')}}</button>
                    </div>
                    </div>
                </div>
                
                </form>
            </div>
            </div>
            <br>
        </div>
    </div>                      
</div>
@endsection

@section('scripts')
  <!-- Custom js for this page-->
        name: 'required',
  <script src="/js/dashboard.js"></script>
  <script src="/js/todolist.js"></script>
  <script src="/js/tablesorter.js"></script>
  <script src="/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>
    $("#form").validate({
      rules: {
        name: 'required',
        lastname: 'required',
        email: {
            required : true,
            email : true
        },
        fonction: 'required',
        phone: 'required',
        filiale_id: 'validateSelect',
        role: 'validateSelect',
        permission_id: 'validateSelect'
      },
      messages: {
        name: "{{__('validation.required',['attribute'=> __('common.name')])}}",
        lastname: "{{__('validation.required',['attribute'=> __('common.lastname')])}}",
        email: {
            required : "{{__('validation.required',['attribute'=> __('common.email')])}}",
            email : "{{__('validation.email',['attribute'=>__('common.email')])}}"
        },
        fonction: "{{__('validation.required',['attribute'=> __('admin/setting.fonction')])}}",
        phone: "{{__('validation.required',['attribute'=> __('common.phone')])}}",
        filiale_id: "{{__('validation.exists',['attribute'=> __('common.subsidiary')])}}",
        role: "{{__('validation.exists',['attribute'=> __('common.category')])}}",
        permission_id: "{{__('validation.exists',['attribute'=> __('common.role')])}}",
        
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