@extends('layouts.admin')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        @include('layouts.adminnavigation')
        <div class="col-md-9">
            <div class="card">
            <div class="card-body">
                <form id="form" class="form-sample" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Delais pour placer une commande</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="date" name="date" value="{{old('date') ?? $date->data}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Ecart entre chaque relance</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="delay" name="delay" value="{{old('delay') ?? $delay->data}}" />
                            </div>
                            <label class="col-sm-3 col-form-label">{{__('common.days')}}</label>
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
        delay: 'required',
        date: 'required'
      },
      messages: {
        delay: "{{__('validation.required',['attribute'=> 'le delais'])}}",
        date: "{{__('validation.required',['attribute'=> 'la date'])}}",
        
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