@extends('layouts.supplier')

@section('content')
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/document.my_expedition_document')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Filiale</th>
                                    <th>Date de chargement</th>
                                    <th>Date de modification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($documents as $document)
                            @php $doc = \App\Models\Document::where('type', 'expedition')->where('filiale_id', $document['filiale_id'])->where('user_id', auth()->user()->supplier->id)->first() @endphp
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><a href="#" class="link-green-ora">{{$document['filialename']}}</a></td>
                                    @if($doc)
                                    <td>{{$doc->created_at}}</td>
                                    <td>{{$doc->updated_at}}</td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    @endif
                                    <td>
                                        @if(!\App\Models\Setting::where('subsidary', $document['filiale_id'])->first())
                                            <i>Aucun document d'expedition n'a ete cree pour cette filiale</i>
                                        @else
                                        <a href="{{route('supplier.expedition.detail', $document['filiale_id'])}}" title="Voir details"><i class="mdi mdi-eye fa-2x text-info-ora icon-sm"></i> </a>
                                        @endif
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
</div>
@endsection