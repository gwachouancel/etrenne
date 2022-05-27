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
                    <h4 class="card-title"> {{__('admin/navigation.close_app')}}</h4>
                </div>
                </div>
                <br>
                <div class="table-responsive">
                <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 ">
                    <form class="forms-sample text-center"> 
                        <p>{{__('admin/setting.close_app')}}</p> 
                        <br>                      
                        <a href="{{route('admin.setting.close',0)}}" class="btn btn-lg btn-rounded btn-success">{{__('common.yes_button')}}</a>
                        <a href="{{route('admin.dashboard')}}" class="btn btn-lg btn-rounded btn-secondary">{{__('common.no_button')}}</a>
                        <br>
                    </form>
                </div>
                <div class="col-md-6 grid-margin grid-margin-lg-0 grid-margin-md-0 ">
                    
                </div>
                
                </div>
            </div>
            </div>
            <br>

        </div>
    </div>                      
</div>
@endsection