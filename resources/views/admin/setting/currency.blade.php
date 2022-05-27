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
                            <h4 class="card-title"> {{__('admin/navigation.currency')}}</h4>
                        </div>
                    </div>
                    <br>
                    <form class="forms-sample" method="POST" id="form">
                        @csrf 
                        <div class="table-responsive">
                            <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 ">
                                    <p>{{__('admin/setting.choose_currency')}}</p> 
                                    <br>                      
                                    <select class="form-control" name="currency" id="currency">
                                        <option {{$currency=='EUR'?"selected":""}} value="EUR">EUR</option>
                                        <option {{$currency=='XAF'?"selected":""}} value="XAF">XAF</option>
                                        <option {{$currency=='XOF'?"selected":""}} value="XOF">XOF</option>
                                    </select>
                                    <br>
                            </div>
                            <div class="col-md-4 ora-pos-right">
                                <div class="form-group row">
                                    <button class="btn btn-light">{{__('common.cancel')}}</button>&nbsp;&nbsp;
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

@section('script')
<script>
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