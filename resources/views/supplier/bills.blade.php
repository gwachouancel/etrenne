@extends('layouts.supplier')

@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <label><h4 class="card-title">Mes factures globales</h4> </label>
                    <br>
                    <div class="table-sorter-wrapper table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="sortStyle">Date de chargement<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Date de modification<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Fichier<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Actions</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><strong>Globale</strong></td>

                                    @php $bill=\App\Models\Document::where('type', 'bill')
                                    ->where('name', '_GLOBALE_')->where('user_id', Auth::user()->supplier->id)->first();
                                    
                                    $canGlobalDownload=false;
                                    @endphp

                                    @if($bill)
                                        @php
                                        $canGlobalDownload=true;
                                        @endphp
                                        <td>{{$bill->created_at}}</td>
                                        <td>{{$bill->updated_at}}</td>
                                        <td><a href="#" class="link-green-ora">{{substr($bill->path,15, strlen($bill->path) - 15)}}</a></td>
                                        <td>                      
                                            <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$bill->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                            <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="document" value="{{$bill->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form>    
                                        </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="#" class="link-green-ora">-</a></td>
                                    <td>      
                                        <button style='border:none;cursor:pointer;background:transparent;' onclick="$(this).next().find('input').click()"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_name" value="_GLOBALE_" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form> 
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Acompte 1</strong></td>
                                    @php $bill=\App\Models\Document::where('type', 'bill')
                                    ->where('name', '_ACCOMPTE_1_')->where('user_id', Auth::user()->supplier->id)->first();
                                    @endphp

                                    @if($bill)
                                        @php
                                        $canGlobalDownload=true;
                                        @endphp
                                        <td>{{$bill->created_at}}</td>
                                        <td>{{$bill->updated_at}}</td>
                                        <td><a href="#" class="link-green-ora">{{substr($bill->path,15, strlen($bill->path) - 15)}}</a></td>
                                        <td>                              
                                            <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$bill->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                            <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="document" value="{{$bill->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form>
                                        </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="#" class="link-green-ora">-</a></td>
                                    <td>                              
                                        <button style='border:none;cursor:pointer;background:transparent;' onclick="$(this).next().find('input').click()"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_name" value="_ACCOMPTE_1_" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form> 
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Acompte 2</strong></td>
                                    @php $bill=\App\Models\Document::where('type', 'bill')
                                    ->where('name', '_ACCOMPTE_2_')->where('user_id', Auth::user()->supplier->id)->first();
                                    @endphp

                                    @if($bill)
                                        @php
                                        $canGlobalDownload=true;
                                        @endphp
                                        <td>{{$bill->created_at}}</td>
                                        <td>{{$bill->updated_at}}</td>
                                        <td><a href="#" class="link-green-ora">{{substr($bill->path,15, strlen($bill->path) - 15)}}</a></td>
                                        <td>                              
                                            <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$bill->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                            <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="document" value="{{$bill->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form>    
                                        </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="#" class="link-green-ora">-</a></td>
                                    <td>                              
                                        <button style='border:none;cursor:pointer;background:transparent;' onclick="$(this).next().find('input').click()"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_name" value="_ACCOMPTE_2_" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Acompte 3</strong></td>
                                    @php $bill=\App\Models\Document::where('type', 'bill')
                                    ->where('name', '_ACCOMPTE_3_')->where('user_id', Auth::user()->supplier->id)->first();
                                    @endphp

                                    @if($bill)
                                        @php
                                        $canGlobalDownload=true;
                                        @endphp
                                        <td>{{$bill->created_at}}</td>
                                        <td>{{$bill->updated_at}}</td>
                                        <td><a href="#" class="link-green-ora">{{substr($bill->path,15, strlen($bill->path) - 15)}}</a></td>
                                        <td>                              
                                            <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$bill->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                            <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="document" value="{{$bill->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form>
                                        </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="#" class="link-green-ora">-</a></td>
                                    <td>                              
                                    <button style='border:none;cursor:pointer;background:transparent;' onclick="$(this).next().find('input').click()"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                        <form action="{{route('supplier.globalbill.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_name" value="_ACCOMPTE_3_" />
                                            <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                        </form>
                                    </td>
                                    @endif
                                </tr>                        
                            </tbody>
                        </table>
                    </div>

                    @if($canGlobalDownload)
                    <div class="form-group ora-pos-right">
                      <br><br>
                      <a href="{{route('supplier.globalbills.downloadzip', Auth::user()->supplier->id)}}" class="link-green-ora">Tout Télécharger (ZIP)</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>          
    </div>
    <br>

    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{__('supplier/document.my_bill_per_filiale')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Filiale</th>
                                    <th>Date de chargement</th>
                                    <th>Date de modification</th>
                                    <th>Fichiers</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($filiales as $each)
                                @php $doc=\App\Models\Document::where("type", "bill")->where("user_id", Auth::user()->supplier->id)->where('filiale_id', $each->id)->first(); @endphp
                                <tr>
                                    <td></td>
                                    <td>{{$each->name}}</td>
                                    @if($doc)
                                        <td>{{$doc->created_at}}</td>
                                        <td>{{$doc->updated_at}}</td>
                                        <td><a href="#" class="link-green-ora">{{$doc->name}}</a></td>
                                        <td>
                                            <a href="#" onclick="remove('{{__('common.alert_delete')}}','{{$doc->id}}')" title="Supprimer"><i class="fa fa-times fa-2x text-info-ora icon-sm"></i> </a>&nbsp;&nbsp;
                                            <button style="border:none;cursor:pointer;background:transparent;" onclick="$(this).next().find('input').click()"><i class="fa fa-exchange fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.bill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="filiale" value="{{$each->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form>
                                        </td>
                                    @else 
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <button style='border:none;cursor:pointer;background:transparent;' onclick="$(this).next().find('input').click()"><i class="fa fa-plus fa-2x text-info-ora icon-sm"></i> </button>                       
                                            <form action="{{route('supplier.bill.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="filiale" value="{{$each->id}}" />
                                                <input name="file" type="file" style="display:none;" accept="application/pdf,image/*" onchange="$(this).parent().submit()" />
                                            </form> 
                                        </td>
                                    @endif
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
                location.href = "{{route('supplier.bill.delete')}}/"+doc;
            }
        });
    }

  </script> 
@endsection