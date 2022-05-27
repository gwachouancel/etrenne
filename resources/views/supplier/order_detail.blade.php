

@extends('layouts.supplier')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h4 class="card-title"><a href="{{route('supplier.orders')}}" title="Retour aux Commandes"><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commandes - Filiale {{$order->Filiale->name}}</h4>
                        </div>
                        @if($order->isblocked)
                            {{__('common.order_blocked')}}
                        @else
                        <div class="br-wrapper br-theme-bars-movie mb-4">
                            <input type="hidden" value="{{ route('supplier.order.status', $order) }}" id="url">
                            <input type="hidden" value="{{$order->status}}" id="default_status"/>
                            <select id="change-order-status" name="rating" autocomplete="off" style="display: none;">
                                <option value="production_start">{{__('supplier/order.production_start')}}</option>
                                <option value="production_end">{{__('supplier/order.production_end')}}</option>
                                <option value="to_transit">{{__('supplier/order.to_transit')}}</option>
                                <option value="boarding">{{__('supplier/order.boarding')}}</option>
                                <option value="order_sent">{{__('supplier/order.order_sent')}}</option>

                            </select>
                        </div>
                        @endif
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th></th>
                                <th>Ref. catalogue</th>
                                <th>Type</th>
                                <th>Ref. produit</th>
                                <th>Nom produit</th>
                                <th>Page</th>
                                <th>Quantite</th>
                                <th>Prix unitaire ({{\App\Models\Setting::where('slug','currency')->first()->data}})</th>
                                <th>Prix total ({{\App\Models\Setting::where('slug','currency')->first()->data}})</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order_)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><strong>{{$order_->ref_catalog}}</strong></td>
                                    <td>{{strtoupper($order_->type)}}</td>
                                    <td>{{strtoupper($order_->ref_product)}}</td>
                                    <td>{{$order_->product_name}}</td>
                                    <td>{{$order_->page}}</td>
                                    <td>{{$order_->quantity}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($order_->price)}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($order_->quantity * $order_->price)}}</td>
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

    @if(!$order->isblocked)
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commentaires</h4>
                    <div class="table-responsive">
                        <form class="forms-sample" action="{{route('supplier.message.submit', $order)}}" method="POST">
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
    @endif
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

@section('scripts')
<script src="{{ asset('/js/form-addons.js') }}"></script>
@endsection

@endsection