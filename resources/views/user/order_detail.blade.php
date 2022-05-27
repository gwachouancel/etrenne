

@extends('layouts.admin')

@section('content')
<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h4 class="card-title"><a href="{{route('user.orders')}}" title="Retour aux Commandes"><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commandes - Filiale {{$order->filiale->name}}</h4>
                        </div>
                            <i>
                                @if($order)
                                    @if($order->isblocked)
                                        {{__('common.can_edit_no')}}
                                    @endif
                                @endif
                            </i>
                    </div>

                    @if(!$order->isblocked)
                    <form method="POST" action="{{route('user.order.new')}}"> 
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Fournisseur</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="supplier" id="supplier">
                                            <option></option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{strtoupper($supplier->company)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Reference du Catalogue</label>
                                    <div class="col-sm-9">
                                        
                                        <select class="form-control" name="ref_catalog" id="ref_catalog">
                                            @foreach($references as $ref => $val)
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="type">
                                            <option value="vip">VIP</option>
                                            <option value="public">Grand Public</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Page</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="page" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Reference Produit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ref_product" value="{{old('ref_product')}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom du Produit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Quantite</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="quantity" value="{{old('quantity')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prix Unitaire (En {{$currency}})</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price" value="{{old('price')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <button class="btn btn-light">Annuler</button>&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-primary mr-2">Ajouter a la commande</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

                    <br />
                    
                </div>
            </div>
        </div>
    </div>

    <br />
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th class="sortStyle"></th>
                                <th class="sortStyle">Ref. catalogue</th>
                                <th class="sortStyle">Type</th>
                                <th class="sortStyle">Ref. produit</th>
                                <th class="sortStyle">Nom produit</th>
                                <th class="sortStyle">Page</th>
                                <th class="sortStyle">Quantite</th>
                                <th class="sortStyle">Prix unitaire ({{$currency}})</th>
                                <th class="sortStyle">Prix total ({{$currency}})</th>
                                <th>Actions</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $_order)
                                
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><strong>{{$_order->ref_catalog}}</strong></td>
                                    <td>{{strtoupper($_order->type)}}</td>
                                    <td>{{strtoupper($_order->ref_product)}}</td>
                                    <td>{{$_order->product_name}}</td>
                                    <td>{{$_order->page}}</td>
                                    <td>{{$_order->quantity}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($_order->price)}}</td>
                                    <td>{{\App\Library\FormatNumber::setNumberFormat($_order->quantity * $_order->price)}}</td>
                                    <td>
                                        <a href="{{route('user.orderitem.delete', $_order)}}" title="Supprimer"><i class="fa fa-trash-o fa-2x text-info-ora icon-sm"></i> </a>&nbsp;
                                        <a href="{{route('user.order.orderitem', [$order, $_order])}}" title="Editer"><i class="fa fa-edit fa-2x text-info-ora icon-sm"></i> </a>
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

    @if(!$order->isblocked)
    <br>
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commentaires</h4>
                    <div class="table-responsive">
                        <form class="forms-sample" action="{{route('user.message.submit', $order)}}" method="POST">
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
                                Message # From 
                                @if($comment->user_id == Auth::user()->id || $comment->filiale_id == Auth::user()->filialeid)
                                    Me
                                @else
                                    Filiale
                                @endif
                                {{$loop->iteration}}
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
    $('#supplier').on('change', function (e) {
        var data = $(this).val();
        var url = "{{route('user.getsuppliercatalogs')}}"

        jQuery.post(
            url,
            {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                supplier: data
            }, function(d) {
                var out = ""
                $.each(d, function(k,v){
                    out +="<option value=" + v +">" + v + "</option>";
                })

                $("#ref_catalog").html()
                $("#ref_catalog").html(out)
            }).done(function(data) {
            }).fail(function(){

            });
    })
</script>
@endsection