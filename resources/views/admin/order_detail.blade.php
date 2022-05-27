

@extends('layouts.admin')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h4 class="card-title"><a href="{{route('admin.orders')}}" title="Retour aux Commandes"><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commandes </h4>
                        </div>

                        @if(isset($order) && $order->isblocked)
                            Cette commande est bloquee
                        @endif
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Filiales</th>
                                    <th class="sortStyle">Ref. catalogue</th>
                                    <th class="sortStyle">Type</th>
                                    <th class="sortStyle">Ref. produit</th>
                                    <th class="sortStyle">Nom produit</th>
                                    <th class="sortStyle">Page</th>
                                    <th class="sortStyle">Quantite</th>
                                    <th class="sortStyle">Prix unitaire ({{$currency}})</th>
                                    <th class="sortStyle">Prix total ({{$currency}})</th>                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $ord)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\App\Models\Filiale::find($ord->Order->filiale_id)->name}}</td>
                                    <td><strong>{{$ord->ref_catalog}}</strong></td>
                                    <td>{{strtoupper($ord->type)}}</td>
                                    <td>{{strtoupper($ord->ref_product)}}</td>
                                    <td>{{$ord->product_name}}</td>
                                    <td>{{$ord->page}}</td>
                                    <td>{{$ord->quantity}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($ord->price)}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($ord->quantity * $ord->price)}}</td>
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