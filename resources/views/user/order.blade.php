@extends('layouts.admin')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper"> 
            <div class="row">
                <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <h4 class="card-title">{{__('supplier/order.order_per_branch') . " " . $filiale}}</h4>
                                </div>
                                <i>
                                    @if($orders)
                                        @if(!$orders->isblocked)
                                        {{__('common.can_edit_yes')}}
                                        @else
                                            {{__('common.can_edit_no')}}
                                        @endif
                                    @endif
                                </i>
                            </div>

                            <!-- Check if an order exist for this filiale -->
                            @if(!$orders)
                                <form action="" method="POST">
                                    @csrf()
                                    <button class="btn btn-primary">Créer une commande pour cette filiale</button>
                                </form>
                            @else

                            <br>
                            <div class="table-responsive">
                                <table id="sortable-table-1" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th class="sortStyle"></th>
                                        <th class="sortStyle">Filiale</th>
                                        <th class="sortStyle">Date de création</th>
                                        <th class="sortStyle">Statut</th>
                                        <th class="sortStyle">Montant ({{$currency}})</th>
                                        <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php 
                                        $array_status = [
                                            'production_start' => '<label class="badge badge-warning">' . __('supplier/order.production_start') . '</label>',
                                            'production_end' => '<label class="badge badge-success">' . __('supplier/order.production_end') . '</label>',
                                            'to_transit' => '<label class="badge badge-info">' . __('supplier/order.to_transit') . '</labeel>',
                                            'order_sent' => '<label class="badge badge-warning">' . __('supplier/order.order_sent') . '</label>',
                                            'boarding' => '<label class="badge badge-info">' . __('supplier/order.boarding') . '</label>'
                                        ]; 
                                    @endphp

                                        <tr>
                                            <td>{{$orders->id}}</td>
                                            <td>{{$orders->filiale->name}}</td>
                                            <td>{{date("d F Y", strtotime($orders->created_at))}}</td>
                                            <td>
                                                {!!key_exists($orders->status, $array_status)? $array_status[$orders->status] : ""!!}
                                            </td>
                                            <td>
                                                {{\App\Library\FormatNumber::setNumberFormat($orders->getPriceAttribute())}}
                                            </td>
                                            <td>
                                                <a href="{{route('user.order.download', $orders)}}" title="Telecharger la commande"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                                <a href="{{route('user.order.display', $orders)}}" title="Details de la commande"><i class="mdi mdi-cart fa-2x text-info-ora icon-sm"></i> </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>
<br>
@endsection