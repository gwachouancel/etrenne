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
                            <h4 class="card-title"><a href="{{route('admin.permissions')}}" title=""><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; {{$title}}</h4>
                        </div>
                    </div>
                    <br>
                    <form id="form" class="form-sample" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{__('common.code')}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="code" name='code' value="{{old('code')??$permission->code}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{__('common.name')}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')??$permission->name}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{__('common.status')}}</label>
                                    <div class="col-sm-9">
                                    @php $status = old('status') ?? $permission->status @endphp
                                        <select class="form-control" name="status">
                                            <option {{$status==1?"selected":""}} value='1'>{{__('common.active')}}</option>
                                            <option {{$status==0?"selected":""}} value='0'>{{__('common.inactive')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{__('common.menus')}}</label>
                                    <div class="col-sm-9">
                                        @php $sMenus = old('menus') ?? $permission->MenusIds @endphp
                                        <select class="form-control js-example-basic-multiple" name="menus[]" multiple="multiple">
                                            @foreach($menus as $menu)
                                            <option {{in_array($menu->id, $sMenus??[])?"selected":""}} value="{{$menu->id}}">{{__($menu->code)}}</option>
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
  <script src="/js/dashboard.js"></script>
  <script src="/js/todolist.js"></script>
  <script src="/js/tablesorter.js"></script>
  <script src="/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>
    $("#form").validate({
      rules: {
        name: {
          required: true,
        },
        code: {
          required: true,
        }
      },
      messages: {
        name: {
          required: "{{__('validation.required',['attribute'=> __('common.name')])}}",
        },
        code: "{{__('validation.required',['attribute'=> __('common.code')])}}",
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