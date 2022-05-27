@extends('layouts.supplier')

@section('content')
<div class="content-wrapper"> 
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="align-items-start justify-content-between">        
                        <form action="{{route('supplier.expedition.detail', $filiale)}}" id="changeFiliale" method="POST">
                            @csrf()  
                            <div class="form-group">

                                <label><h4 class="card-title">{{__('supplier/document.my_expedition_document')}} &nbsp; {{auth()->user()->supplier->company}}</h4></label>
                                <select class="js-example-basic-single" style="width:100%;color:#000;outline: 1px solid #000;" name="filiale" onchange="$('#changeFiliale').submit()">
                                        <option>Choisir une filiale</option>
                                    @foreach($filiales as $filiale_)
                                        <option value="{{$filiale_->id}}" @if($filiale->id == $filiale_->id) selected @endif>{{$filiale_->name}}</option>
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
                                    <th></th>
                                    <th class="sortStyle">Date de chargement</th>
                                    <th class="sortStyle">Date de modification</th>
                                    <th class="sortStyle">Fichier</th>
                                    <th class="sortStyle">Actions</th>                            
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($settings as $setting)
                            @php $doc = \App\Models\Document::where('type', 'expedition')->where('type_id', $setting->id)->where('user_id', auth()->user()->supplier->id)->first() @endphp
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$setting->data}}</td>
                                    @if($doc)
                                    <td>{{$doc->created_at}}</td>
                                    <td>{{$doc->updated_at}}</td>
                                    <td>{{$doc->name}}</td>
                                    <td>                              
                                        <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$doc->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                        <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()" title="Remplacer"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.expedition.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="filiale" value="{{$filiale->id}}" />
                                            <input type="hidden" name="setting" value="{{$setting->id}}" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form>
                                    </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>       
                                        <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()" title="Ajouter"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.expedition.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="filiale" value="{{$filiale->id}}" />
                                            <input type="hidden" name="setting" value="{{$setting->id}}" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group ora-pos-right">
                        <br><br>
                        <a href="{{route('supplier.expedition.downloadzip',$filiale)}}" class="link-green-ora">Tout Télécharger (ZIP)</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function remove(title, doc){
        swal({
            title: '{{__('common.confirm')}}',
            text: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
            cancel: {
                text: "{{__('common.cancel')}}",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "{{__('common.ok')}}",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
            }
        }).then((result) => {
            if (result) {
                location.href = "{{route('supplier.expedition.delete')}}/"+doc;
            }
        });
    }

  </script> 
@endsection