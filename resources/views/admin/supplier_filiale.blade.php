@extends('layouts.admin')

@section('content')
<div class="content-wrapper">          
@php $currency = \App\Models\Setting::where('slug','currency')->first()->data @endphp
<div class="row">
    <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <h4 class="card-title"><a href="{{route('admin.supplier.display',$supplier)}}" title="Retour aux Commandes"><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; Commande - Fournisseur {{$supplier->company}} - {{$filiale->name}}</h4>
            </div>
            
          </div>
          <br>
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
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr>
                  <td>{{$loop->index+1}}.</td>
                  <td>{{$order->ref_catalog}}</td>
                  <td>{{$order->type}}</td>
                  <td>{{$order->ref_product}}</td>
                  <td>{{$order->product_name}}</td>
                  <td>{{$order->page}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>{{\App\Library\FormatNumber::setNumberFormat($order->price)}}</td>
                  <td>{{\App\Library\FormatNumber::setNumberFormat($order->cost)}}</td>
                </tr>
                @endforeach                          
              </tbody>
            </table>
          </div>
          <div>
            <br>
            {{--<button type="submit" class="btn btn-danger btn-danger-ora mr-2 float-right">Telecharger en PDF</button>--}}
          </div>
        </div>
      </div>
    </div>          
  </div>
  <br>
            

</div>
@endsection