@extends('layouts.supplier')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/catalog.add_catalog_title')}}</h4>

                    <form method="POST" action="{{route('supplier.catalogs')}}" enctype="multipart/form-data" >
                    @csrf
                        <div class="row row-ora">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="ref_catalog" class="">{{__('common.ref_catalog')}}</label>
                                    <input type="text" class="form-control" name="ref_catalog" value="{{old('ref_catalog')}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name" class="">{{__('common.name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="upload" class="">{{__('common.file')}}(PDF, JPG, PNG)</label>
                                    <input type="file" class="form-control" name="upload" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="">{{__('supplier/catalog.catalog_type')}}</label>
                                    <select class="form-control form-control-ora" name="type">
                                    <option value="gift">{{__('supplier/catalog.gift')}}</option>
                                    <option value="agenda">{{__('supplier/catalog.agenda')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary">{{__('supplier/catalog.add_catalog')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th></th>
                                <th>{{__('common.ref_catalog')}}</th>
                                <th>{{__('supplier/catalog.name')}}</th>
                                <th>{{__('supplier/catalog.catalog_create_date')}}</th>
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
                                            <a href="{{ route('supplier.catalog.download', $agenda) }}" title="Telecharger le catalogue"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                            <a href="{{ route('supplier.catalog.delete', $agenda) }}" title="Supprimer le catalogue"><i class="fa fa-trash-o fa-2x text-info-ora icon-sm"></i> </a>
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
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th></th>
                    <th>{{__('common.ref_catalog')}}</th>
                    <th>{{__('supplier/catalog.name')}}</th>
                    <th>{{__('supplier/catalog.catalog_create_date')}}</th>
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
                                    <a href="{{ route('supplier.catalog.download', $cadeau) }}" title="Telecharger le catalogue"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                    <a href="{{ route('supplier.catalog.delete', $cadeau) }}" title="Supprimer le catalogue"><i class="fa fa-trash-o fa-2x text-info-ora icon-sm"></i> </a>
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