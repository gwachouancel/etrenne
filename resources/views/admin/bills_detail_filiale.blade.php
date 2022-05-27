@extends('layouts.admin')

@section('content')

<div class="content-wrapper">          
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <label><h4 class="card-title">Factures - {{$filiale->name}}</h4> </label>
                    <br>
                    <div class="table-sorter-wrapper table-responsive">
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
                                @foreach($bills as $bill)

                                    @if(!in_array($bill->name, ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_']))
                                        <tr>
                                            <td><a href="#" class="link-green-ora">{{\App\Models\Supplier::find($bill->user_id)->company}}</a></td>
                                            <td></td>
                                            <td>{{$bill->created_at}}</td>
                                            <td>{{$bill->updated_at}}</td>
                                            <td>
                                                <a href="{{route('admin.supplier.expedition.download', $bill)}}" title="Telecharger" download><i class="mdi mdi-download fa-2x text-info-ora icon-sm"></i> </a>
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

    <br />
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commentaires</h4>
                    <div class="table-responsive">
                        <form class="forms-sample" action="" method="POST">
                            @csrf
                            <div class="form-group">
                            <textarea class="form-control" id="message" rows="4" name="message" value="{{old('message')}}"></textarea>
                            </div>
                            <div class="ora-pos-right">
                            <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <br>

    <br />
    <div class="row">              
        <div class="col-md-12 ">                
            <div class="card">
                <div class="card-body">
                    @foreach($comments as $comment)

                    <div class="d-flex align-items-start profile-feed-item line-up-sabc">
                        <div class="ml-4">
                            <h6>
                                Message # From 
                                @if($comment->user_id == Auth::user()->id)
                                    Me
                                @else
                                    Filiale
                                @endif
                                {{$loop->iteration}}
                                <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>{{date("F d Y H:s", strtotime($comment->created_at))}}</small>
                            </h6>
                            <p>
                                {{$comment->comment}}    
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                                ---
                            </p>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection