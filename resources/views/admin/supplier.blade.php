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
                <form class="form-sample" id="form" method="POST" enctype="multipart/form-data">
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
                                <label class="col-sm-3 col-form-label">{{__('common.companyname')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="company" name="company" value="{{old('company')??$user->companyname}}" />
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
                                <label class="col-sm-3 col-form-label">{{__('common.address')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')??$user->companyaddress}}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('common.country')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control js-example-basic-multiple" id="country" name="country">
                                        <option value="">{{__('common.choose_a_value')}}</option>
                                        @foreach($filiales as $fil)
                                            @if( old('country')==$fil->code || $user->suppliercountry == $fil->code )
                                            <option selected="selected" value="{{$fil->code}}">{{__('country.'.$fil->code)}}</option>
                                            @else
                                            <option value="{{$fil->code}}">{{__('country.'.$fil->code)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('common.phone')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="999 999 999" id="phone" name="phone" value="{{old('phone')??$user->phone}}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('common.producttype')}}</label>
                                <div class="col-sm-9">
                                    @php $producttype = old('product_type') ?? $user->producttype @endphp
                                    <select class="form-control" id="product_type" name="product_type">
                                        <option {{$producttype=='agenda'?"selected":""}} value="agenda">{{__('common.agenda')}}</option>
                                        <option {{$producttype=='gift'?"selected":""}} value="gift">{{__('common.gift')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{__('admin/setting.rib')}}</label>
                                <div class="col-sm-9">
                                    <label>{{old('rib')??$user->supplier ? $user->supplier->rib:''}}</label>
                                    <input class="form-control" type="file" name="rib" id="rib" accept="image/*,application/pdf" />
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
        address: 'required',
        company: 'required',
        //rib: 'required',
        email: {
            required : true,
            email : true
        },
        phone: 'required',
        country: 'validateSelect',
      },
      messages: {
        name: "{{__('validation.required',['attribute'=> __('common.name')])}}",
        lastname: "{{__('validation.required',['attribute'=> __('common.lastname')])}}",
        email: {
            required : "{{__('validation.required',['attribute'=> __('common.email')])}}",
            email : "{{__('validation.email',['attribute'=>__('common.email')])}}"
        },
        phone: "{{__('validation.required',['attribute'=> __('common.phone')])}}",
        address: "{{__('validation.required',['attribute'=> __('common.phone')])}}",
        //rib: "{{__('validation.required',['attribute'=> __('admin/setting.rib')])}}",
        company: "{{__('validation.required',['attribute'=> __('common.phone')])}}",
        country: "{{__('validation.required',['attribute'=> __('common.country')])}}"
        
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