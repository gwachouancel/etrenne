@extends('layouts.supplier')

@section('content')
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/order.order_per_branch')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Commande ID</th>
                                    <th>Filiales</th>
                                    <th>Date de création</th>
                                    <th>Statut</th>
                                    <th>Montant ({{$currency}})</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {!!$output!!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection