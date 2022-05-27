@extends('layouts.admin')

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
            <h4 class="card-title">Commandes</h4>
            <div class="d-flex justify-content-between">
            <p class="text-muted">{{$confirmed}} confirmées</p>
            <p class="text-muted">Total: {{$cmds}}</p>
            </div>
            <div class="progress progress-md">
            <div class="progress-bar bg-info" style="width:{{$cmds ? ($confirmed*100)/$cmds : 0}}%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
            <div class="progress-bar bg-danger" style="width:{{$batCount ? ($batPending*100)/$batCount : 0}}%" role="progressbar" aria-valuenow="{{$batPending}}" aria-valuemin="0" aria-valuemax="{{$batCount}}"></div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Production terminée</h4>
            <div class="d-flex justify-content-between">
            <p class="text-muted">{{$completed}}</p>
            <p class="text-muted">Total: {{$cmds}}</p>
            </div>
            <div class="progress progress-md">
            <div class="progress-bar bg-warning" style="width:{{$cmds ? ($completed*100)/$cmds : 0}}%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        </div>
    </div>
    </div>

    @if($lastOrder->count())
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Les dernieres commandes envoyées</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="sortStyle"></th>
                    {{--<th class="sortStyle"></th>--}}
                    <th class="sortStyle">Filiales</th>
                    <th class="sortStyle">Type</th>
                    <th class="sortStyle">Montant total ({{\App\Models\Setting::where('slug','currency')->first()->data}})</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lastOrder as $order)
                    <tr>
                        <td>{{$loop->index+1}}.</td>
                        {{--<td>
                        <a class="link-green-ora" >commande num {{$order->id}}</a>
                        </td> --}}
                        <td>{{$order->filiale->name}}</td>
                        <td>{{$order->type}}</td>
                        <td>{{\App\Library\FormatNumber::setNumberFormat($order->price)}}</td>
                        <td>                                
                            <a href="{{route('admin.byorder.display',$order)}}" title="Voir la commande"><i class="mdi mdi-eye text-info-ora icon-sm"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                
                <a href="{{route('admin.orders')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
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

    @if($lastCatalog->count())
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Les derniers catalogues chargés</h4>
            <div class="table-responsive">
                <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">Type</th>
                    <th class="sortStyle">Fournisseurs</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lastCatalog as $cat)
                    <tr>
                        <td>
                            {{$loop->index+1}}.
                        </td>
                        <td>
                            <a class="link-green-ora" >{{$cat->ref_catalog}}</a> 
                        </td>
                        <td>
                            {{__('common.'.$cat->type)}}
                        </td>
                        <td>
                            @php $user = auth()->user(); @endphp
                            @if( $user->hasMenu('admin.supplier.display') )
                            <a class="link-green-ora" href="{{route('admin.supplier.display', $cat->supplier)}}">{{$cat->supplier->company}}</a>
                            @else
                            {{$cat->supplier->company}}
                            @endif
                        </td>
                        <td>                                
                            <a href="{{route('admin.catalog.download',$cat)}}" title="Telecharger le Catalogue"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                <a href="{{route('admin.marketplace')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
                <p class="text-black mb-0">Voir tous les catalogues</p>
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
            <h4 class="card-title">Les derniers documents chargés</h4>
            <div class="table-responsive">
                <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">Filiales</th>
                    <th class="sortStyle">Type</th>
                    <th >Actions</th>
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
                            <a href="{{route('admin.bat.download',$doc)}}" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                            {{--<a href="#" title="Supprimer le Document"><i class="fa fa-times text-info-ora icon-sm"></i> </a>--}}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>
                <a href="{{route('admin.documents.expeditions')}}" class="view-more-wrapper mt-3 d-flex align-items-center">
                <p class="text-black mb-0">Voir tous les documents</p>
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