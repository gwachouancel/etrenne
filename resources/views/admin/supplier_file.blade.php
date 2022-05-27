@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          

  <div class="row">
    <div><h3>Fournisseur - {{$supplier->company}}</h3><br></div>
    <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="align-items-start justify-content-between">                      
              <div class="form-group">
                <h4 class="card-title">Choisir un fournisseur</h4>
                <form method="post" id="form">
                @csrf
                <select id="select-filiales" name="supplier_id" class="form-control js-example-basic-multiple" style="width:100%;color:#000;outline: 1px solid #000;" onchange="form.submit()">
                    <option value="">Choisir un fournisseur</option>
                      @foreach($suppliers as $sup)
                      <option value="{{$sup->id}}">{{$sup->company}}</option>
                      @endforeach
                </select>
                </form>
              </div>                         
            </div>
        </div>
      </div>
    </div>  
      <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">                
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Commande globale</h4>
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
                    <th class="sortStyle">BAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                  <tr>
                    <td>{{$loop->index+1}}.</td>
                    <td>{{$order->ref_catalog}}</td>
                    <td>{{__('common.'.$order->type)}}</td>
                    <td>{{$order->ref_product}}</td>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->page}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>
                      @if($order->bat->status === "pending") 
                          <label class="badge badge-warning">
                      @endif
                      @if($order->bat->status === "approuved") 
                          <label class="badge badge-success">
                      @endif
                      @if($order->bat->status === "rejected") 
                          <label class="badge badge-danger">
                      @endif
                          {{__('common.'.$order->bat->status)}}
                      </label>
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
    <br>
    <div class="row">
      <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Commandes - {{$supplier->company}} Par Filiale</h4>
            <div class="table-responsive">
              <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">Date de creation</th>
                    <th class="sortStyle">Date de modification</th>
                    <th class="sortStyle">Montant ({{\App\Models\Setting::where('slug','currency')->first()->data}})</th>
                    <th class="sortStyle">Statut</th>  
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($filiales as $fil)
                  <tr>
                    <td>{{$loop->index+1}}.</td>
                    <td>
                      @if(auth()->user()->hasMenu('admin.supplier.filiale'))
                      <a class="link-green-ora" href="{{route('admin.supplier.filiale',['supplier'=>$supplier,'filiale'=>$fil->filiale])}}">{{$fil->filiale->name}}</a>
                      @else
                      {{$fil->filiale->name}}
                      @endif  
                  </td>
                    <td>{{$fil->created_at->format('d-m-Y')}}</td>
                    <td>{{$fil->updated_at->format('d-m-Y')}}</td>
                    <td>{{$fil->price}}</td>
                    <td>
                      <label class="badge badge-info">
                      {{__('common.'.$fil->status)}}
                      </label>
                    </td>
                    <td>                                
                      <a href="{{route('admin.order.download.filiale',$fil)}}" title="Telecharger la commande"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>&nbsp;
                      <a href="{{route('admin.order.display',$fil)}}" title="Voir le detail"><i class="mdi mdi-eye text-info-ora icon-sm"></i> </a>
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
    <br>
    <div class="row">
      <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Documents recents expeditions - {{$supplier->company}}</h4>
            <div class="table-responsive">
              <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">Filiale</th>
                    <th class="sortStyle">Date de chargement</th>
                    <th class="sortStyle">Type</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                  <tbody>
                      @foreach($documents as $doc)
                      <tr>
                          <td>{{$loop->index+1}}.</td>
                          <td>
                              <a class="link-green-ora" href="#">{{$doc->name}}</a> 
                          </td>
                          <td>
                              {{$doc->filialename}}
                          </td>
                          <td>
                              {{$doc->created_at->format('d-m-Y')}}
                          </td>
                          <td>
                              {{__('common.'.$doc->type)}}
                          </td>
                          <td>                                
                              <a href="{{route('admin.bat.download',$doc)}}" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                              {{--<a href="#" title="Supprimer le Document"><i class="fa fa-times text-info-ora icon-sm"></i> </a>--}}
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
    <br>
    <div class="row">
      <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Documents récents factures - {{$supplier->company}}</h4>
            <div class="table-responsive">
              <table id="sortable-table-1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="sortStyle"></th>
                    <th class="sortStyle"></th>
                    <th class="sortStyle">Filiales</th>
                    <th class="sortStyle">Type</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($bills as $doc)
                    <tr>
                        <td>{{$loop->index+1}}.</td>
                        <td>
                            <a class="link-green-ora" href="#">{{$doc->name}}</a> 
                        </td>
                        <td>
                            {{$doc->filialename}}
                        </td>
                        <td>
                            {{__('common.'.strtolower($doc->type))}}
                        </td>
                        <td>                                
                            <a href="{{route('admin.bat.download',$doc)}}" title="Telecharger le Document"><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
                            {{--<a href="#" title="Supprimer le Document"><i class="fa fa-times text-info-ora icon-sm"></i> </a>--}}
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
    <br>
  </div>
</div>
@endsection