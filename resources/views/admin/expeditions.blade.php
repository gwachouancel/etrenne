@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <label><h4 class="card-title">Documents expeditions par fournisseur</h4> </label>
                    <br>
                    <div class="table-sorter-wrapper table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Date de chargement</th>
                                    <th class="sortStyle">Date de modification</i></th>
                                    <th>Actions</th>                            
                                </tr>
                            </thead>
                            <tbody id="display_document">
                                @foreach($documents as $document)
                                <tr>
                                    <td><a href="#" class="link-green-ora">{{\App\Models\Supplier::find($document->user_id)->company}}</a></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{$document->updated_at}}</td>
                                    <td>
                                        <a href="{{route('admin.expedition.downloadzip', $document->user_id)}}" title="Telecharger(ZIP)" download><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                        <a href="{{route('admin.expeditions.supplier', $document->user_id)}}" title="Detail"><i class="mdi mdi-eye fa-2x text-info-ora icon-sm"></i> </a>
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

    <br />
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <label><h4 class="card-title">Documents expeditions par Filiale</h4> </label>
                    <br>
                    <div class="align-items-start justify-content-between">        
                        <form action="" id="changeFiliale" method="POST">
                            @csrf()  
                            <div class="form-group">

                                <select class="js-example-basic-single" style="width:100%" name="filiale" onchange="$('#changeFiliale').submit()">
                                        <option>Choisir une filiale</option>
                                    @foreach($filiales as $filiale_)
                                        <option value="{{$filiale_->id}}" @if(isset($filiale)) @if($filiale->id == $filiale_->id) selected @endif @endif>{{$filiale_->name}}</option>
                                    @endforeach
                                </select>
                            </div>     
                        </form>             
                    </div>
                    <br>
                    <div class="table-sorter-wrapper table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="sortStyle">Fournisseur(s)</th>
                                    <th class="sortStyle">Date de chargement</th>
                                    <th class="sortStyle">Date de modification</th>
                                    <th class="sortStyle">Actions</th>                            
                                </tr>
                            </thead>
                            <tbody id="display_document">
                                @foreach($documentsFiliales as $document)
                                <tr>
                                    <td><a href="#" class="link-green-ora">{{$document->Filiale->name}}</a></td>
                                    <td><span class="link-green-ora">{{\App\Models\Supplier::find($document->user_id)->company}}</span></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{$document->updated_at}}</td>
                                    <td>
                                        <a href="{{route('admin.supplier.expedition.download', $document->id)}}" title="Telecharger" download><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                        <!-- <a href="{{route('admin.expeditions.supplier', $document->user_id)}}" title="Detail"><i class="mdi mdi-eye fa-2x text-info-ora icon-sm"></i> </a> -->
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
@endsection