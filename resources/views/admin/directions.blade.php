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
                            <h4 class="card-title"><a href="{{route('admin.dashboard')}}" title=""><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; {{__('admin/navigation.directions')}}</h4>
                        </div>
                        <a href="{{route('admin.direction.new')}}" class="btn btn-primary btn-sm btn-icon-text">
                            <i class="fa fa-plus btn-icon-prepend"></i>
                            {{__('admin/setting.add_direction')}}
                        </a>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <table id="sortable-table-1" class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="sortStyle">{{__('common.name')}}</th>
                            <th class="sortStyle">{{__('common.email')}}</th>
                            <th class="sortStyle">{{__('common.status')}}</th>
                            <th>{{__('common.actions')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($directions as $dir)
                          <tr>
                            <td>{{$dir->name}}</td>
                            <td>{{$dir->email}}</td>
                            <td>
                              @if($dir->status == 1)
                                <label class="badge badge-success">{{__('common.active')}}</label>
                              @else
                                <label class="badge badge-danger">{{__('common.inactive')}}</label>
                              @endif
                            </td>
                            <td>                                
                                <a href="{{route('admin.direction.edit',$dir)}}" ><i class="mdi mdi-pencil text-info-ora icon-sm"></i> </a>&nbsp;
                                <i onclick="remove('{{__('common.alert_delete')}}', '{{$dir->id}}')" class="mdi mdi-close text-info-ora icon-sm" style="cursor:pointer;"></i>
                            </td>
                          </tr>  
                          @endforeach                       
                        </tbody>
                      </table>
                      
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>                      
</div>
@endsection

@section('scripts')
  <!-- Custom js for this page-->
  <script src="/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>

function remove(title, direction){
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
            location.href = "{{route('admin.direction.delete')}}/"+direction;
        }
    });
}

</script> 
  @endsection