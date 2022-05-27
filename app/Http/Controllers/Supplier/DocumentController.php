<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Order;
use App\Models\Filiale;
use App\Models\Setting;
use App\Models\OrderItem;
use App\Models\Supplier;
use  Auth;
use Zip;

class DocumentController extends Controller
{
    //
    public function expedition(){
        // Recuperer toutes les filiales pour lesquelle le supplier connecte a une ligne de commande
        $orders = Order::get();
        $result = $orders->map(function($order){
            
            if($order->Items()->where("supplier_id", Auth::user()->supplier->id)->first()){
                return $order;
            }
        });
        // $orders=OrderItem::where("supplier_id", Auth::user()->Supplier->id)->get();

        $getSuppliersOrdersFiliales=OrderItem::select('orders.filiale_id')
            ->join("orders", 'orders.id', 'orderitems.order_id')
            ->where("supplier_id", Auth::user()->supplier->id)->get();
        $sort_list = [];
        $documents = [];
        foreach($getSuppliersOrdersFiliales as $each){
            if(!in_array($each->filiale_id, $sort_list)){
                $sort_list[]=$each->filiale_id;
                $documents[] = [
                    'filiale_id' => $each->filiale_id,
                    'filialename' => Filiale::find($each->filiale_id)->name
                ];
            }
        }
    
        // $documents = Document::where("type", "expedition")->where("user_id", Auth::user()->id)->get();

        return view("supplier.expeditions")->with( compact('documents'));
    }

    //
    public function expedition_detail(Request $request, Filiale $filiale){
        
        if($request->isMethod('POST')){
            $this->validate($request, [
                'filiale' => 'required|exists:filiales,id'
            ]);

            $filiale = Filiale::find($request->filiale);
        }

        $filiales = Filiale::all();
        $settings = Setting::where('slug', 'document')
            ->where('subsidary', $filiale->id)->get();

        return view('supplier.expeditions_detail')->with( compact('filiales','settings', 'filiale') );
    }

    public function getDocumentsByFiliale(Request $request){
        if($request->isMethod('POST')){
            $results= Document::where("type", "expedition")->where("user_id", Auth::user()->supplier->id)->where('filiale_id', $request->filiale_id)->get();
            
            $output = "";
            foreach($results as $result) {
                $output .= "<tr>";
                $output .= "<td></td>";
                $output .= "<td>$result->name</td>";
                $output .= "<td>$result->created_at</td>";
                $output .= "<td>$result->updated_at</td>";
                $output .= "<td><a href='" . $result->path. "'>$result->path</a></td>";
                $output .= "<td>
                    <a href='" . route('supplier.expedition.delete', $result) ."' title='Supprimer'><i class='fa fa-times text-info-ora icon-sm'></i> </a>&nbsp;&nbsp;
                    <a href='" . route('supplier.expedition.update', $result) ."' title='Remplacer'><i class='fa fa-exchange text-info-ora icon-sm'></i> </a>
                </td>";
                $output .= "</tr>";
            }

            $settings = Setting::where('slug', 'document')->where('subsidary', $request->filiale_id)->get();
            foreach($settings as $setting){
                $output .= "<tr>";
                $output .= "<td></td>";
                $output .= "<td>$setting->data</td>";
                $output .= "<td>-</td>";
                $output .= "<td>-</td>";
                $output .= "<td>-</td>";
                $output .= "<td>
                <div class='upload-btn-wrapper'>
                    <i class='fa fa-plus text-info-ora icon-sm' id='btn_upload'>dd</i>
                    
                </div>
                </td>";
                $output .= "</tr>";
            }
            return response()->json(["output" => $output]);
        }
    }

    public function uploadFile(Request $request){
        if($request->isMethod("POST") && ($file = $request->file('file'))){

            $validate=Validator::make($request->all(), [
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            ],[],['file'=>'Le fichier']);

            if($validate->fails()){
                $errors = [];
                foreach($validate->errors()->all() as $error){
                    $errors[] = $error;
                }
                return redirect()->back()->with('error', $errors);
            }
            
            $path = $file->store('expeditions/' . date("Ymd"));
            
            if( ($doc = Document::where('filiale_id',$request->filiale)->where('type_id',$request->setting)->where('type','expedition')->first() ) ){
                
                if(file_exists(public_path().'/'.$doc->path)){
                    unlink(public_path().'/'.$doc->path);
                }

                $doc->update([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                ]);
            }else{
                Document::create([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                    'status' => 'approuved',
                    'type' => 'expedition',
                    'filiale_id' => $request->filiale,
                    'user_id' => Auth::user()->supplier->id,
                    'type_id' => $request->setting
                ]);
            }
            // route('supplier.expedition.detail', $document['filiale_id'])
            return redirect()->route('supplier.expedition.detail', $request->filiale)->with('success', 'Document téléversé !');
        }
        return redirect()->back()->with('error', 'Erreur lors du Téléversement !');
    }

    public function delete(Document $doc){
        if(file_exists(public_path().'/'.$doc->path)){
            unlink(public_path().'/'.$doc->path);
        }
        $doc->delete();

        return redirect()->route('supplier.expedition.detail', $docc->filiale_id)->with('error', 'Document supprimé avec success');

        // return redirect()->back()->with('error', 'Document supprimé avec success');
    }

    public function bills(Request $request){
        $filiales=Filiale::all()->where('status', true);
        return view('supplier.bills')->with( compact('filiales') );
    }

    public function uploadGlobalBillFile(Request $request){
        if($request->isMethod("POST") && ($file = $request->file('file'))){
            
            $path = $file->storeAs('bills/' . date("Ymd") , $file->getClientOriginalName());
            
            if( ($doc = Document::where('id',$request->document)
                ->where("user_id", Auth::user()->supplier->id)->where('type','bill')->first() ) ){
                
                if(file_exists(public_path().'/'.$doc->path)){
                    unlink(public_path().'/'.$doc->path);
                }
                
                $doc->update([
                    'path' => $path,
                    'mime' => $file->getMimeType()
                ]);
            }else{
                Document::create([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $request->_name,
                    'status' => 'approuved',
                    'type' => 'bill',
                    'user_id' => Auth::user()->supplier->id,
                ]);
            }
            return redirect()->back()->with('success', 'Document téléversé !');
        }
        return redirect()->back()->with('error', 'Erreur lors du Téléversement !');
    }

    public function uploadBillFile(Request $request){
        if($request->isMethod("POST") && ($file = $request->file('file'))){
            
            $path = $file->store('bills/' . date("Ymd"));
            
            if( ($doc = Document::where('filiale_id',$request->filiale)
                ->where("user_id", Auth::user()->supplier->id)->where('type','bill')->first() ) ){
                
                if(file_exists(public_path().'/'.$doc->path)){
                    unlink(public_path().'/'.$doc->path);
                }
                
                $doc->update([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                ]);
            }else{
                Document::create([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                    'status' => 'approuved',
                    'type' => 'bill',
                    'filiale_id' => $request->filiale,
                    'user_id' => Auth::user()->supplier->id
                ]);
            }
            return redirect()->back()->with('success', 'Document téléversé !');
        }
        return redirect()->back()->with('error', 'Erreur lors du Téléversement !');
    }

    public function getAllExpeditionZip(Request $request, Filiale $filiale){
        $supplier = auth()->user()->supplier;
        $zip = Zip::create("Expedition.$filiale->name.$supplier->company.zip");

        $documents = Document::where("user_id", $supplier->id)
        ->where("type", "expedition")->where("filiale_id", $filiale->id)->get();
        foreach($documents as $document){
            $zip->add($document->path, $document->name);
        }
        return $zip;
    }

    public function getGlobalBillsBySupplierZip(Request $request, Supplier $supplier){
        $zip = Zip::create("FacturesGlobal_$supplier->company.zip");

        $documents = Document::where("user_id", $supplier->id)
        ->where("type", "bill")->whereIn('name', ['_GLOBALE_','_ACCOMPTE_1_','_ACCOMPTE_2_','_ACCOMPTE_3_'])->get();
        foreach($documents as $document){
            $zip->add($document->path, $document->name.substr($document->path,15, strlen($document->path)));
        }
        return $zip;
    }
}