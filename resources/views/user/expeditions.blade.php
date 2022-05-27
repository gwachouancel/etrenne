@extends('layouts.admin')

@php $user = Auth::user(); @endphp

@section('content')
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/document.my_expedition_document')}} @if($user->role !='admin')- Filiale {{$user->filialename}}@endif</h4>
                    <div class="table-responsive">
                        <table id="sortable-table-1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Nom du document</th>
                                    <th class="sortStyle">Date de chargement</th>
                                    <th class="sortStyle">Date de modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($documents as $document)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$document->setting->data}}</td>
                                    <td><a class="link-green-ora" href="{{route('user.expeditions.download', $document)}}" download>{{$document->name}}</a></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{$document->updated_at}}</td>
                                    <td>
                                        <a href="{{route('user.expeditions.download', $document->id)}}" title="Voir details"><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group ora-pos-right">
                        <br><br>
                        <a href="{{route('admin.expedition.downloadzip',$user->filialeid)}}" class="link-green-ora">Tout Télécharger (ZIP)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection