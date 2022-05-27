@extends('layouts.supplier')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 page-title">
            <h4>{{__('auth.welcome',['user'=>auth()->user()->name])}}</h4>

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Commandes reçues</h4>
                <div class="d-flex justify-content-between">
                <p class="text-muted">{{$cmds}} recues</p>
                <p class="text-muted"></p>
                </div>
            </div>
            </div>
        </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">BAT validés</h4>                      
                <div class="d-flex justify-content-between">
                <p class="text-muted">{{$batCompleted}}</p>
                <p class="text-muted">Total: {{$batCount}}</p>
                </div>
                <div class="progress progress-md">
                <div class="progress-bar bg-success" style="width:{{$batCount ? ($batCompleted*100)/$batCount : 0}}%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">BAT en attente</h4>
                <div class="d-flex justify-content-between">
                <p class="text-muted">{{$batPending}}</p>
                <p class="text-muted">Total: {{$batCount}}</p>
                </div>
                <div class="progress progress-md">
                <div class="progress-bar bg-danger" style="width:{{$batCount ? ($batPending*100)/$batCount : 0}}%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        
    </div>
    </div>

    @if($orders->count())
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Commande reçues</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th></th>
                    {{--<th></th>--}}
                    <th>Filiales</th>
                    <th>Montant total (EUR)</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$loop->index+1}}.
                        </td>
                        {{--<td>
                            <a class="link-green-ora" href="{{route('supplier.order.display',$orders[$loop->index])}}">Commande num {{$orders[$loop->index]->id}}</a>
                        </td>--}}
                        <td>
                            {{$orders[$loop->index]->filiale->name}}
                        </td>
                        <td>
                            {{\App\Library\FormatNumber::setNumberFormat($order->price)}} 
                        </td>
                        <td>                                
                            <a href="{{route('supplier.order.display',$orders[$loop->index])}}" title="Voir la commande"><i class="mdi mdi-eye text-info-ora icon-sm"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                
                <a href="{{route('supplier.orders')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
                    <p class="text-black mb-0">Voir toutes les commandes</p>
                    <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                    <i class="mdi mdi-chevron-right text-black"></i>
                    </div>
                </a>
                
            </div>
            </div>
        </div>
        </div>          
    </div>
    <br>
    @endif

    @if($catalogs->count())
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Mes catalogues</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th>Date de chargement</th>
                    <th>Type</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($catalogs as $cat)
                    <tr>
                        <td>
                            {{$loop->index+1}}.
                        </td>
                        <td>
                            <a class="link-green-ora">{{$cat->ref_catalog}}</a> 
                        </td>
                        <td>
                            {{$cat->created_at->format('Y-m-d')}}
                        </td>
                        <td>
                            {{__('common.'.$cat->type)}}
                        </td>
                        <td>                                
                            <a href="{{route('supplier.catalog.download',$cat)}}" title="Telecharger le Catalogue"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                            <a href="{{route('supplier.catalog.delete',$cat)}}" title="Supprimer le Catalogue"><i class="fa fa-times text-info-ora icon-sm"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                <a href="{{route('supplier.catalogs')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
                <p class="text-black mb-0">Voir mes catalogues</p>
                <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                    <i class="mdi mdi-chevron-right text-black"></i>
                </div>
                </a>
            </div>
            </div>
        </div>
        </div>          
    </div>
    <br>
    @endif

    @if($documents->count())
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Mes derniers documents chargés</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th>Filiales</th>
                    <th>Type</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $doc)
                    @if(!is_null($doc->filiale))
                    <tr>
                        <td>{{$loop->index+1}}.</td>
                        <td>
                            <a class="link-green-ora" href="#">{{$doc->name}}</a> 
                        </td>
                        <td>
                        
                            {{$doc->filiale->name}}
                        </td>
                        <td>
                            @if($doc->type=="bill") 
                                Facture
                            @else
                                Expedition
                            @endif
                        </td>
                        <td>                                
                            <a href="{{route('supplier.bat.download',$doc)}}" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                            {{--<a href="#" title="Supprimer le Document"><i class="fa fa-times text-info-ora icon-sm"></i> </a>--}}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>
                <a href="{{route('supplier.expeditions')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
                <p class="text-black mb-0">Voir tous mes documents</p>
                <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                    <i class="mdi mdi-chevron-right text-black"></i>
                </div>
                </a>
            </div>
            </div>
        </div>
        </div>          
    </div>
    @endif
    <br>
</div>
@endsection