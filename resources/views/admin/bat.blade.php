@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          

    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="align-items-start justify-content-between">                      
                        <div class="form-group">
                            <h4 class="card-title">{{__('supplier/bat.add_sup_bat_list')}}</h4>
                            <form method="post" id="form">
                            @csrf
                            <select id="select-filiales" name="supplier" class="form-control js-example-basic-multiple" style="width:100%;color:#000;outline: 1px solid #000;" onchange="form.submit()">
                                <option value="">Choisir un fournisseur</option>
                                @foreach($suppliers as $sup)
                                    <option {{$sup->id == $supplier->id ? "selected":""}} value="{{$sup->id}}">{{$sup->company}}</option>
                                @endforeach
                            </select>
                            </form>
                        </div>                         
                    </div>

                    <br>
                    <div class="table-sorter-wrapper table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                        <thead>
                            <tr>
                            <th class="sortStyle"></th>
                            <th class="sortStyle">Ref. catalogue</th>
                            <th class="sortStyle">Type</th>
                            <th class="sortStyle">Fournisseur</th>
                            <th class="sortStyle">Ref. produit</th>
                            <th class="sortStyle">Nom produit</th>
                            <th class="sortStyle">Page</th>
                            <th class="sortStyle">Quantite</th>
                            <th class="sortStyle">Statut BAT</th>
                            <th>Actions</th>                            
                            </tr>
                        </thead>
                        <tbody id="table-filiales">
                            @foreach($bats as $bat)
                            @php $order = $bat->order; @endphp
                                <tr id="filiale_{{$order->Order->id}}">
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        <a class="link-green-ora" href="{{route('admin.bat.display', $order->id)}}">{{$order->ref_catalog}}</a>
                                    </td>
                                    <td>
                                        {{$order->type}}
                                    </td>
                                    <td>
                                        @php $user = auth()->user(); @endphp
                                        @if( $user->hasMenu('admin.supplier.display') )
                                        <a class="link-green-ora" href="{{route('admin.supplier.display', $order->supplier)}}">{{$order->supplier->company}}</a>
                                        @else
                                        {{$order->supplier->company}}
                                        @endif
                                    </td>                                                
                                    <td>
                                        {{$order->ref_product}}
                                    </td>
                                    <td>
                                        {{$order->product_name}}
                                    </td>
                                    <td>
                                        {{$order->page}}
                                    </td>
                                    <td>
                                        {{$order->quantity}}
                                    </td>
                                    <td>
                                        @if($bat->status === "pending") 
                                            <label class="badge badge-warning">
                                        @endif
                                        @if($bat->status === "approuved") 
                                            <label class="badge badge-success">
                                        @endif
                                        @if($bat->status === "rejected") 
                                            <label class="badge badge-danger">
                                        @endif
                                            {{__('common.'.$order->bat->status)}}
                                        </label>
                                    </td>
                                    <td>                              
                                        <a href="{{route('admin.bat.display', $order->id)}}" title="Voir le detail BAT"><i class="mdi mdi-eye text-info-ora icon-sm"></i> </a>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                        </table>
                    </div>
                    <div>
                    </div>
                </div>
            </div>

        </div>          
    </div>
      <br>
                
  </div>

@endsection

@section('scripts')

<script>

    const selectFiliales = document.querySelector('#select-filiales');
    const tableFiliales = document.querySelectorAll('#table-filiales > tr');

    selectFiliales.addEventListener('change', (event) => {
        
        tableFiliales.forEach((item) => {

            item.style.display = "table-row";

            if(event.target.value !== item.id && event.target.value !== "Choisir une filiale"){

                item.style.display = "none";

            }  
                  
        });                
    
    });

</script>

@endsection
