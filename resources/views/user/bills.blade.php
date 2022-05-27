@extends('layouts.admin')

@php $user = Auth::user(); @endphp

@section('content')
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mes factures - Filiale {{$user->filialename}}</h4>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Fournisseurs</th>
                                    <th class="sortStyle">Date de chargement</th>
                                    <th class="sortStyle">Date de modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($documents as $document)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="#" class="link-green-ora">{{\App\Models\Supplier::find($document->user_id)->company}}</a></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{$document->updated_at}}</td>
                                    <td>
                                        <a href="{{asset($document->path)}}" title="Telechargez" download><i class="mdi mdi-download fa-2xx text-info-ora icon-sm"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(count($documents) >0)
                    <div class="form-group ora-pos-right">
                        <br><br>
                        <a href="{{route('admin.bills.perfiliale',$user->filialeid)}}" class="link-green-ora">Tout Télécharger (ZIP)</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection