@extends('layouts.supplier')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/catalog.add_catalog_title')}}</h4>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/catalog.catalog_agenda')}}</h4>
                    <div class="table-responsive">
                        
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">{{__('common.ref_catalog')}}</th>
                                <th class="sortStyle">{{__('supplier/catalog.name')}}</th>
                                <th class="sortStyle">{{__('supplier/catalog.catalog_create_date')}}</th>
                                <th>{{__('common.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($catalogs as $agenda)
                                @if($agenda->type == 'agenda')
                                    <tr> 
                                        <td>
                                            {{$loop->index+1}}.
                                        </td>
                                        <td>
                                            {{$agenda->ref_catalog}}.
                                        </td>
                                        <td>
                                            <a class="link-green-ora" href="#">{{$agenda->name}}</a>
                                        </td>
                                        <td>
                                            {{date("d F Y", strtotime($agenda->created_at))}}
                                        </td>
                                        <td>                                
                                            <a href="{{ route('supplier.catalog.download', $agenda) }}" title="Telecharger le catalogue"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>         
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">{{__('supplier/catalog.catalog_gift')}}</h4>
            <div class="table-responsive">
                <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">{{__('common.ref_catalog')}}</th>
                    <th class="sortStyle">{{__('supplier/catalog.name')}}</th>
                    <th class="sortStyle">{{__('supplier/catalog.catalog_create_date')}}</th>
                    <th>{{__('common.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $key=1; @endphp
                    @foreach($catalogs as $cadeau)
                        @if($cadeau->type == 'gift')
                            <tr>
                                <td>
                                    {{$key++}}.
                                </td>
                                <td>
                                    {{$cadeau->ref_catalog}}
                                </td>
                                <td>
                                    <a class="link-green-ora" href="#">{{$cadeau->name}}</a>
                                </td>
                                <td>
                                    {{date("d F Y", strtotime($cadeau->created_at??now()))}}
                                </td>
                                <td>                                
                                    <a href="{{ route('supplier.catalog.download', $cadeau) }}" title="Telecharger le catalogue"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                                </td>
                            </tr>

                        @endif
                @endforeach   
                </tbody>
                </table>
            </div>
            </div>                
        </div>
        </div>                        
    </div>
    <br>
    <br>
</div>
@endsection