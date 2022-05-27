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
                <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th class="sortStyle"></th>
                    {{--<th></th>--}}
                    <th class="sortStyle">Filiales</th>
                    <th class="sortStyle">Type</th>
                    <th class="sortStyle">Montant Total (EUR)</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lastOrder as $order)
                    <tr>
                        <td>{{$loop->index+1}}.</td>
                        <td>commande num {{$order->id}}</td>
                        <td>{{$order->filiale->name}}</td>
                        <td>{{$order->type}}</td>
                        <td>{{$order->price}}</td>
                        <td>                                
                            <a href="{{route('admin.order.display',$order)}}" title="Voir la commande"><i class="mdi mdi-eye text-info-ora icon-sm"></i> </a>
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
                            <a class="link-green-ora" href="#">{{$cat->ref_catalog}}</a> 
                        </td>
                        <td>
                            {{__('common.'.$cat->type)}}
                        </td>
                        <td>
                            {{$cat->supplier->company}}
                        </td>
                        <td>                                
                            <a href="#" title="Telecharger le Catalogue"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                <a href="#" class="view-more-wrapper mt-3 d-flex align-items-center">
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
                    <th class="sortStyle">Fournisseur</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        1.
                    </td>
                    <td>
                        <a class="link-green-ora" href="#">FACT num 1</a> 
                    </td>
                    <td>
                        Burkina Faso
                    </td>
                    <td>
                        Facture
                    </td>
                    <td>
                        AGM Print
                    </td>
                    <td>                                
                        <a href="#" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        2.
                    </td>
                    <td>
                        <a class="link-green-ora" href="#">DED num 1</a> 
                    </td>
                    <td>
                        Togo
                    </td>
                    <td>
                        Cadeaux
                    </td>
                    <td>
                        Digital SARL
                    </td>
                    <td>                                
                        <a href="#" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                    </td>
                    </tr>
                </tbody>
                </table>
                <a href="#" class="view-more-wrapper mt-3 d-flex align-items-center">
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
    <br>
</div>
@endsection