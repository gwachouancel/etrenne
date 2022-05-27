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
                            <h4 class="card-title"><a href="{{route('admin.dashboard')}}" title=""><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; {{__('admin/setting.document_title')}} </h4>
                        </div>
                    </div>
                    <br>

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    @if(Session::has('success'))
                        <p class="badge badge-success">{{Session::get('success')}}</p>
                    @endif

                    <form method="POST" class="form-sample" >
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">{{__('admin/setting.document_name')}}</label>
                                    <input class="form-control" name="data" value="{{old('data')??$setting->data}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">{{__('admin/setting.filiales')}}</label>
                                    <select class="form-control form-control-ora" name="subsidary">
                                    @foreach($subsidaries as $sub)    
                                    <option value="{{$sub->id}}" {{$sub->id == $setting->subsidary ?"selected":""}} >{{$sub->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary">{{__('common.save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                      <table id="sortable-table-1" class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="sortStyle">{{__('common.name')}}</th>
                            <th class="sortStyle">{{__('admin/navigation.filiales')}}</th>
                            <th>{{__('common.actions')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $doc)
                          <tr>
                            <td>
                                {{$doc->data}}
                            </td>
                            <td>
                                {{$doc->getFiliale($doc->subsidary)}}
                            </td>
                            <td>
                                <a href="{{route('admin.setting.document.edit', $doc)}}" title="Editer le document"><i class="mdi mdi-pencil text-info-ora icon-sm"></i> </a>&nbsp;
                                <i onclick="remove('{{__('common.alert_delete')}}', '{{$doc->id}}')" class="mdi mdi-close text-info-ora icon-sm" style="cursor:pointer;"></i>
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

        function remove(title, setting){
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
                    location.href = "{{route('admin.setting.document.delete')}}/"+setting;
                }
            });
        }
        
    </script>

@endsection