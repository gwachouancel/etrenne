@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="align-items-start justify-content-between">
                        <div class="form-group">
                            <label><h4 class="card-title">Documents expeditions - {{$supplier->company}}</h4> </label>
                            <select class="js-example-basic-single" style="width:100%;color:#000;outline: 1px solid #000;" id="drop_filiale">
                                <option></option>
                                @foreach($filiales as $filiale)
                                <option value="{{$filiale->id}}">{{$filiale->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="table-sorter-wrapper table-responsive">
                        <table id="sortable-table-1" class="table table-striped sortable-table table-hover">
                            <thead>
                                <tr>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle"></th>
                                    <th class="sortStyle">Date de chargement<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Date de modification<i class="mdi mdi-chevron-down"></i></th>
                                    <th class="sortStyle">Actions</th>                            
                                </tr>
                            </thead>
                            <tbody id="display_document">
                                @foreach($documents as $document)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="#" class="link-green-ora">{{$document->name}}</a></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{$document->updated_at}}</td>
                                    <td>
                                        <a href="{{route('admin.supplier.expedition.download', $document)}}" title="Telecharger" download><i class="mdi mdi-download text-info-ora icon-sm"></i> </a>
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

@section('scripts')
<script src="/js/select2.js"></script>

<script>
    $('#drop_filiale').on('select2:select', function (e) {
        var data = e.params.data;
        var url = "{{route('admin.supplier.documents')}}"
        jQuery.post(
            url,
            {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                filiale: data.id,
                supplier: "{{$supplier->id}}"
            }, function(data) {
                var $output = $("#display_document"),
                text = $.parseHTML(data.documents)
                $output.html()
                $output.html(text)
            }).done(function(data) {
                console.log(data)
                showToast('success', "", "{!! Session::get('success') !!}");
            }).fail(function(){

            });
    });
</script>
@endsection