@extends('layouts.admin')

@section('content')
@php 
    $array_status = [
        'production_start' => '<label class="badge badge-warning">' . __('supplier/order.production_start') . '</label>',
        'production_end' => '<label class="badge badge-success">' . __('supplier/order.production_end') . '</label>',
        'to_transit' => '<label class="badge badge-info">' . __('supplier/order.to_transit') . '</labeel>',
        'order_sent' => '<label class="badge badge-warning">' . __('supplier/order.order_sent') . '</label>',
        'boarding' => '<label class="badge badge-info">' . __('supplier/order.boarding') . '</label>'
    ]; 
@endphp
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/order.order_per_supplier')}}</h4>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">Fournisseurs</th>
                                <th class="sortStyle">Montant ({{$currency}})</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orderPerSupplier as $order)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    @php $user = auth()->user(); @endphp
                                    <td>
                                        @if( $user->hasMenu('admin.supplier.display') )
                                        <a class="link-green-ora" href="{{route('admin.supplier.display', $order['supplier_id'])}}">{{$order['suppliername']}}</a>
                                        @else
                                        {{$order['suppliername']}}
                                        @endif
                                    </td>
                                    
                                    <td>
                                        {{\App\Library\FormatNumber::setNumberFormat($order['price'])}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.order.download', $order['supplier_id'])}}" title="Telecharger la commande"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                        <a href="{{route('admin.order.display', $order['supplier_id'])}}" title="Details de la commande"><i class="mdi mdi-eyes fa-2x text-info-ora icon-sm"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/order.order_per_branch')}}</h4>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">Filiales</th>
                                <th class="sortStyle">Date de création</th>
                                <th class="sortStyle">Date de modification</th>
                                <th class="sortStyle">Statut</th>
                                <th class="sortStyle">Montant ({{$currency}})</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orderPerFiliales as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a class='link-green-ora' href='#'>{{$order['filialename']}}</a></td>
                                    <td>{{date("d F Y", strtotime($order['created_at']))}}</td>
                                    <td>
                                        {{date("d F Y h:s", strtotime($order['updated_at']))}}
                                    </td>
                                    <td>
                                        {!!$array_status[$order['status']]!!}<br><br>
                                        @if($order['isblocked'])
                                            <i>Commande bloquee</i>
                                        @endif
                                    </td>
                                    <td>
                                        {{number_format($order['price'], 0, ' ', ' ')}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.order.download.filiale', $order['order_id'])}}" title="Télécharger la commande"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                        <a href="{{route('admin.orders.filiale', $order['filiale_id'])}}" title="Détails de la commande"><i class="mdi mdi-eye fa-2x text-info-ora icon-sm"></i> </a>
                                    </td>
                                </tr>
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