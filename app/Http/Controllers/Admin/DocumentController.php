<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Filiale;
use App\Models\Document;
use App\Models\Comment;
use Auth;
use Zip;

class DocumentController extends Controller
{
    //

    public function getDocumentExpedition(Request $request, Supplier $supplier){
        $documents=Document::where("type", "expedition")->where("user_id", $supplier->id)->orderby("created_at", "DESC")->get();

        $filiales=Filiale::all();

        return view('admin.supplier_expedition')->with(compact('documents', 'filiales', 'supplier'));
    }

    public function getDocumentExpeditionByFiliale(Request $request){
        if($request->isMethod("POST")){
            $documents=Document::where("type", "expedition")->where("user_id", $request->supplier)->where('filiale_id', $request->filiale)->orderby("created_at", "DESC")->get();

            $output = "";
            foreach($documents as $document){
                $output .="<tr>";
                $output .="<td></td>";
                $output .="<td>$document->name</td>";
                $output .="<td>$document->created_at</td>";
                $output .="<td>$document->updated_at</td>";
                $output .="<td>
                    <a href='" . route('admin.supplier.expedition.download', $document) ."' title='Telecharger' download><i class='mdi mdi-download text-info-ora icon-sm'></i> </a>
                    </td>";
                $output .="</tr>";
            }
            return response()->json(['documents'=>$output]);
        }
    }

    public function getAllExpeditions(Request $request){
        $documentsFiliales = Document::where("type", "expedition")->get();
        if($request->isMethod("POST")){
            $documentsFiliales = Document::where("type", "expedition")->where("filiale_id", $request->filiale)->get();
        }
        $documents = Document::distinct("user_id")->where("type", "expedition")->get();
        $filiales = Filiale::all();
        return view('admin.expeditions')->with( compact('documents', 'filiales', 'documentsFiliales') );
    }

    public function download(Document $document){
        return \Storage::download($document->path, $document->name);
    }

    public function getAllExpeditionZip(Request $request, Filiale $filiale){
        $zip = Zip::create("Expedition.$filiale->name.zip");

        if(auth()->user()->role=='admin'){
            $documents = Document::where("type", "expedition")->get();
        }else{
            $documents = Document::where("type", "expedition")->where("filiale_id", $filiale->id)
        ->where("type", "expedition")->get();
        }
        foreach($documents as $document){
            $zip->add($document->path, $document->name);
        }
        return $zip;
    }

    // Bills
    public function bills(Request $request){
        $filiales=Filiale::where('status', true)->get();
        $bills=Document::where("type", "bill")->get();
        $singleSupplier=array();
        $output="";
        foreach($bills as $bill){
            if(!in_array($bill->user_id, $singleSupplier) && in_array($bill->name, ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_'])){
                array_push($singleSupplier, $bill->user_id);
            }
        }
        return view('admin.bills')->with( compact('filiales', 'singleSupplier') );
    }

    public function billsDetailByFiliale(Request $request, Filiale $filiale){
        if($request->isMethod("post")){
            Comment::create([
                'comment'=>$request->message,
                'type_id'=>$filiale->id,
                'type'=>'document_invoice',
                'user_id'=>Auth::user()->id
            ]);
        }
        $bills=Document::where('filiale_id', $filiale->id)
            ->where("type", 'bill')->get();
        $comments=Comment::where("type", "document_invoice")->where("type_id", $filiale->id)->orderby("id", "desc")->get();
        return view('admin.bills_detail_filiale')->with( compact('bills', 'filiale', 'comments') );
    }

    // Download bills per filiale
    public function billsByFiliale(Request $request, Filiale $filiale){
        $zip = Zip::create("Factures.$filiale->name.zip");

        $documents = Document::where("filiale_id", $filiale->id)
        ->where("type", "bill")->get();
        foreach($documents as $document){
            $zip->add($document->path, $document->name);
        }
        return $zip;
    }

    public function globalBillsBySupplier(Request $request, Supplier $supplier){
        $zip = Zip::create("FacturesGlobal_$supplier->company.zip");

        $documents = Document::where("user_id", $supplier->id)
        ->where("type", "bill")->whereIn('name', ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_'])->get();
        foreach($documents as $document){
            $zip->add($document->path, $document->name.substr($document->path,15, strlen($document->path) - 15));
        }
        return $zip;
    }

    public function globalBillsDetailBySupplier(Request $request, Supplier $supplier){
        $globale=Document::where("user_id", $supplier->id)
        ->where("type", "bill")->where('name', '_GLOBALE_')->first();
        $accompte_1=Document::where("user_id", $supplier->id)
        ->where("type", "bill")->where('name', '_ACCOMPTE_1_')->first();
        $accompte_2=Document::where("user_id", $supplier->id)
        ->where("type", "bill")->where('name', '_ACCOMPTE_2_')->first();
        $accompte_3=Document::where("user_id", $supplier->id)
        ->where("type", "bill")->where('name', '_ACCOMPTE_3_')->first();

        if($request->isMethod("post")){
            Comment::create([
                'comment'=>$request->message,
                'type_id'=>$supplier->id,
                'type'=>'document_invoice',
                'user_id'=>Auth::user()->id
            ]);
        }
        $comments=Comment::where("type", "document_invoice")->where("type_id", $supplier->id)->orderby("id", "desc")->get();
        
        return view('admin.global_bills_detail_supplier')->with( compact('globale', 'accompte_1', 'accompte_2', 'accompte_3', 'supplier', 'comments') );
    }
}
