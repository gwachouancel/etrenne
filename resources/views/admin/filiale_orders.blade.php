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
                                <i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commandes - Filiale {{$filiale->name}}</h4>
                        </div>

                        <form id="block_order" method="POST">
                            @csrf()
                            @if($order->isblocked)
                                <input type="hidden" value="unlock" name="type" />
                            @else
                                <input type="hidden" value="lock" name="type" />
                            @endif
                            <input type="hidden" value="{{$order->id}}" name="order" />
                            <button type="button" 
                                @if($order->isblocked)
                                    class="btn btn-success btn-sm btn-icon-text"
                                @else
                                    class="btn btn-danger btn-sm btn-icon-text"
                                    @endif
                                id="btn_submit">
                                <i class="fa fa-window-close btn-icon-prepend"></i>
                                @if($order->isblocked)
                                    Débloquer cette commande
                                @else
                                    Bloquer cette commande
                                @endif
                            </button>
                        </form>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Fournisseurs</th>
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
                                @foreach($orderByFiliale as $orderItem)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a class='link-green-ora' href='#'>{{$orderItem->Supplier->company}}</a></td>
                                        <td>{{$orderItem->ref_catalog}}</td>
                                        <td>{{$orderItem->type}}</td>
                                        <td>{{$orderItem->ref_product}}</td>
                                        <td>{{$orderItem->product_name}}</td>
                                        <td>{{$orderItem->page}}</td>
                                        <td>{{$orderItem->quantity}}</td>
                                        <td>{{\App\Library\FormatNumber::setNumberFormat($orderItem->price)}}</td>
                                        <td>{{\App\Library\FormatNumber::setNumberFormat($orderItem->price * $orderItem->quantity)}}</td>
                                    </tr>
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
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commentaires</h4>
                    <div class="table-responsive">
                        <form class="forms-sample" action="{{route('admin.message.submit', $order)}}" method="POST">
                            @csrf
                            <div class="form-group">
                            <textarea class="form-control" id="message" rows="4" name="message" value="{{old('message')}}"></textarea>
                            </div>
                            <div class="ora-pos-right">
                            <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <br>

    <br />
    <div class="row">              
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">                
            <div class="card">
                <div class="card-body">
                    @foreach($comments as $comment)

                    <div class="d-flex align-items-start profile-feed-item line-up-sabc">
                        <div class="ml-4">
                            <h6>
                                Message # From <strong>{{ucfirst($comment->User->name) . " " . ucfirst($comment->User->lastname)}}</strong>
                            
                                <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>{{date("F d Y H:s", strtotime($comment->created_at))}}</small>
                            </h6>
                            <p>
                                {{$comment->comment}}    
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                                ---
                            </p>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("#btn_submit").on('click', function(e){
        $("#block_order").submit()
    })
</script>
@endsection
