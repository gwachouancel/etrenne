<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Auth;

class DocumentController extends Controller
{
    //
    public function expeditions(Request $request){
        if( auth()->user()->role == 'admin'){
            $documents=Document::where("type", 'expedition')->get();
        }else{
            $documents=Document::where("filiale_id", Auth::user()->filiale_id)->where("type", 'expedition')->get();
        }
        return view("user.expeditions")->with( compact('documents') );
    }

    public function download(Request $request, Document $document){
        return \Storage::download($document->path);
    }

    public function bills(Request $request){
        $documents=Document::where('type', 'bill')->where('filiale_id', Auth::user()->filiale_id)->get();
        return view('user.bills')->with( compact('documents') );
    }

    public function downloadPerFiliale(Request $request){
        
    }
}
