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
                        <h4 class="card-title"> {{__('admin/navigation.users')}}</h4>
                    </div>
                    <a href="{{route('admin.user.new')}}" class="btn btn-primary btn-sm btn-icon-text">
                        <i class="fa fa-plus btn-icon-prepend"></i>
                        {{__('admin/setting.add_user')}}
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="sortable-table-1" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">{{__('admin/setting.fullname')}}</th>
                                <th class="sortStyle">{{__('admin/navigation.permissions')}}</th>
                                <th class="sortStyle">{{__('common.email')}}</th>
                                <th class="sortStyle">{{__('common.status')}}</th>
                                <th class="sortStyle">{{__('common.actions')}}</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <a class="link-green-ora" href="{{route('admin.user.edit',$user)}}">{{$user->fullname}}</a>
                                </td>
                                <td>{{$user->permissionname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->status == 'active')
                                    <label class="badge badge-success">{{__('common.active')}}</label>
                                    @else
                                    <label class="badge badge-danger">{{__('common.inactive')}}</label>
                                    @endif
                                </td>
                                <td>                                
                                    <a href="{{route('admin.user.edit',$user)}}" ><i class="mdi mdi-pencil text-info-ora icon-sm"></i> </a>&nbsp;
                                    <i onclick="removeUser('{{__('common.alert_delete')}}', '{{$user->id}}')" class="mdi mdi-close text-info-ora icon-sm" style="cursor:pointer;"></i>
                                </td>
                            </tr>  
                            @php $i++ @endphp
                            @endforeach                
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <h4 class="card-title"> {{__('admin/navigation.suppliers')}}</h4>
                    </div>
                    <a href="{{route('admin.supplier.new')}}" class="btn btn-primary btn-sm btn-icon-text">
                        <i class="fa fa-plus btn-icon-prepend"></i>
                        {{__('admin/setting.add_supplier')}}
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="sortable-table-1" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">{{__('admin/setting.fullname')}}</th>
                                <th class="sortStyle">{{__('admin/setting.company')}}</th>
                                <th class="sortStyle">{{__('common.email')}}</th>
                                <th class="sortStyle">{{__('common.status')}}</th>
                                <th>{{__('common.actions')}}</th>                            
                            </tr>
                        </thead>
                        <tbody>

                            @php $i=1 @endphp
                            @foreach($suppliers as $sup)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <a class="link-green-ora" href="{{route('admin.supplier.edit',$sup)}}">{{$sup->fullname}}</a>
                                </td>
                                <td>{{$sup->companyname}}</td>
                                <td>{{$sup->email}}</td>
                                <td>
                                    @if($sup->status == 'active')
                                    <label class="badge badge-success">{{__('common.active')}}</label>
                                    @else
                                    <label class="badge badge-danger">{{__('common.inactive')}}</label>
                                    @endif
                                </td>
                                <td>                                
                                    <a href="{{route('admin.supplier.edit',$sup)}}" ><i class="mdi mdi-pencil text-info-ora icon-sm"></i> </a>&nbsp;
                                    <i onclick="removeSupplier('{{__('common.alert_delete')}}', '{{$sup->id}}')" class="mdi mdi-close text-info-ora icon-sm" style="cursor:pointer;"></i>
                                </td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>                      
</div>
@endsection

@section('scripts')
  <!-- Custom js for this page-->
  <script src="/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>

    function removeUser(title, user){
        swal({
            title: '{{__('common.confirm')}}',
            text: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
            cancel: {
                text: "{{__('common.cancel')}}",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "{{__('common.ok')}}",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
            }
        }).then((result) => {
            if (result) {
                location.href = "{{route('admin.user.delete')}}/"+user;
            }
        });
    }

    function removeSupplier(title, supplier){
        swal({
            title: '{{__('common.confirm')}}',
            text: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
            cancel: {
                text: "{{__('common.cancel')}}",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "{{__('common.ok')}}",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
            }
        }).then((result) => {
            if (result) {
                location.href = "{{route('admin.supplier.delete')}}/"+supplier;
            }
        });
    }

  </script> 
@endsection