@extends('layouts.supplier')

@section('content')

<div class="content-wrapper">          

<div class="row">
    <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <h4 class="card-title"><a href="{{route('supplier.bats')}}" title="Retour aux BAT"><i class="fa fa-arrow-left link-green-ora icon-sm"></i></a>&nbsp;&nbsp; {{$orderitem->title}}</h4>
            </div>
            @if($orderitem->bat->status != 'approuved')
            <button type="button" class="btn btn-primary btn-sm btn-icon-text" onclick="file.click();">
              <i class="fa fa-plus btn-icon-prepend"></i>
              Ajouter un BAT
            </button>
            @endif
          </div>
          <form id="form" method="post" enctype="multipart/form-data"  action="{{route('supplier.batfile.add')}}">
          @csrf
          <input type="hidden" name="bat" value="{{$orderitem->bat->id}}" />  
          <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*,application/pdf" style="display:none" onchange="form.submit()"/>
          </form>
          @foreach($documents as $key => $document)
          <p class="card-text">
            <h4>Proposition {{$loop->index+1}} - {{$key}}</h3>
          </p>
              <div class="attachments-sections">
                <ul>
                @foreach($document as $doc)
                  <li>
                    <div class="thumb"><i class="mdi mdi-file-{{$doc->extension()}}"></i></div>
                    <div class="details">
                      <p class="file-name">{{$doc->name}}</p>
                      <a href="{{route('supplier.bat.download', $doc)}}" style="float:right;margin-top:23px;" class="download">Telecharger</a>
                      <div id="lightgallery" class="buttons lightGallery">
                        <p class="file-size">{{round(Storage::size($doc->path)/1024,2)}}kb</p>
                        @if($doc->extension() != 'pdf')<a href="{{asset($doc->path)}}" class="image-tile view">Voir</a>@endif
                      </div>
                      
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
          @endforeach
                        
        </div>

      </div>
    </div>          
  </div>
  <br>    
  
@if($orderitem->bat->status != 'approuved')
 <div class="row">
  <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Commentaires</h4>
        <div class="table-responsive">
          <form class="forms-sample" method="post">
            @csrf
            <div class="form-group">
              <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
            </div>
            <div class="ora-pos-right">
              <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
              <button type="reset" class="btn btn-light">Annuler</button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>            
 </div> 
  <br>
@endif

  @if($messages->count())
  <div class="row">              
    <div class="col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card">                
      <div class="card">
          <div class="card-body"> 
            @foreach($messages as $msg)                                               
              <div class="d-flex align-items-start profile-feed-item">
                <div class="ml-4">
                  <h6>
                    <span class="text-info-sabc">{{$msg->user->name}}</span>
                    @if( !($msg->user->role=='supplier') )<i class="mdi mdi-star-circle mr-1 link-green-ora"></i>@endif
                    <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>{{$msg->created_at->isoFormat('LLL')}}</small>
                  </h6>
                  <p>
                   {{$msg->comment}}<br>
                  </p>
                </div>
              </div>
            @endforeach
          </div>
      </div>
    </div>         
  </div>
  @endif

</div>
@endsection

@section('scripts')
<script>
  @if ($errors->any())
    let valid = $("#form").validate();
    @foreach ($errors->getMessages() as $key => $value)
        @if( strpos($key, 'menu') === false )
          valid.showErrors({"{{$key}}": "{{$value[0]}}"});
        @else
          valid.showErrors({"menus[]": "{{$value[0]}}"});
        @endif
    @endforeach
  @endif
</script>
<script src="/vendors/lightgallery/js/lightgallery-all.min.js"></script>
<script src="/js/light-gallery.js"></script>
@endsection

@section('styles')
<style>
  .attachments-sections li{
    margin-bottom:10px;
  }
</style>
<link rel="stylesheet" href="/vendors/lightgallery/css/lightgallery.css">
@endsection
