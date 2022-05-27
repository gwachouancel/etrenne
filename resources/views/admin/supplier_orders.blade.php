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
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h4 class="card-title"><a href="{{route('admin.orders')}}" title="Retour aux Commandes">
                                <i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commandes - Fournisseur {{$supplier->company}}</h4>
                        </div>
                        <div>
                            <h4>Statut:&nbsp;&nbsp;{!!$array_status[$firstStatut]!!}</h4>
                        </div>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Filiale</th>
                                    <th class="sortStyle">Ref. catalogue</th>
                                    <th class="sortStyle">Type</th>
                                    <th class="sortStyle">Ref. produit</th>
                                    <th class="sortStyle">Nom produit</th>
                                    <th class="sortStyle">Page</th>
                                    <th class="sortStyle">Quantite</th>
                                    <th class="sortStyle">Prix unitaire (EUR)</th>
                                    <th class="sortStyle">Prix total (EUR)</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderBySupplier as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a class="link-green-ora" href="{{route('admin.orders.filiale', $order->filiale_id)}}">{{$order->Filiale->name}}</a></td>
                                        <td>{{$order->ref_catalog}}</td>
                                        <td>{{$order->getType($order->type)}}</td>
                                        <td>{{$order->ref_product}}</td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->page}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{\App\Library\FormatNumber::setNumberFormat($order->price)}}</td>
                                        <td>{{\App\Library\FormatNumber::setNumberFormat($order->price * $order->quantity, 0)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div>
                        <br>
                        <a href="{{route('admin.supplier.order.download', $supplier)}}" class="btn btn-danger btn-danger-ora mr-2 float-right">Telecharger en PDF</a>
                    </div>

                </div>
            </div>
            </div>          
        </div>
    <br>
</div>
@endsection