@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Factures par filiale</h4>
                    <div class="table-responsive">
                        <table class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Date de chargement<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Date de modification<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Actions</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filiales as $filiale)
                                <tr>
                                    <td><a href="#" class="link-green-ora">{{$filiale->name}}</a></td>

                                    @php
                                        $checkBills=$filiale->documents;
                                        foreach($checkBills as $key => $check){
                                            if(in_array($check->name, ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_'])){
                                                unset($checkBills[$key]);
                                            }
                                        }

                                        if($count=$checkBills->count() > 0){
                                            
                                            echo "<td>" . $checkBills[0]->created_at . "</td>";
                                            echo "<td>" . $checkBills[$count-1]->updated_at . "</td>";
                                            echo "<td>";
                                            echo "<a href='" . route("admin.bills.perfiliale", $filiale) ."' title='Telechargez (ZIP)'><i class='mdi mdi-download fa-2x text-info-ora icon-sm'></i> </a>
                                                <a href='" . route("admin.displaybill.perfiliale", $filiale) . "' title='Details de la commande'><i class='mdi mdi-eye fa-2x text-info-ora icon-sm'></i></a>
                                            </td>";
                                        }else{
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                        }
                                    @endphp
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div>
            </div>
        </div>
    </div>

    <br />
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
        <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Facture globale par fournisseur</h4>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Type</th>
                                    <th class="sortStyle">Date de chargement<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Date de modification<i class="mdi mdi-chevron-down"></i></th>
                                    <th>Actions</th>                            
                                </tr>
                            </thead>
                            <tbody id="display_document">
                                @foreach($singleSupplier as $key => $val)
                                    @php 
                                        $data=\App\Models\Document::where("user_id",$val)->where("type","bill")->whereIn('name', ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_']);
                                    @endphp

                                    @if($data)
                                    <tr>
                                        <td><a href="#" class="link-green-ora">{{\App\Models\Supplier::find($val)->company}}</a></td>
                                        <td></td>
                                        <td>{{$data->first()->created_at}}</td>
                                        <td>{{$data->orderby("id", "desc")->first()->updated_at}}</td>
                                        <td>
                                            <a href="{{route('admin.supplier.global.bill.download', $val)}}" title="Telechargez (ZIP)"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                            <a href="{{route('admin.supplier.global.bill.display', $val)}}" title="Details de la commande"><i class="mdi mdi-eye fa-2x text-info-ora icon-sm"></i> </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div>
            </div>
        </div>
    </div>

</div>
@endsection