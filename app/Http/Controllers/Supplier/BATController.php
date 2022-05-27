<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Bat;
use App\Models\Filiale;
use App\Models\Comment;
use App\Models\Document;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BATController extends Controller
{
    public function index(Request $request)
    {
        $filiales = Filiale::all();
        $supplier_id =auth()->user()->supplier->id;

        if( ($filiale_id = $request->get('filiale')) && $request->isMethod('post') ){
            /*$orders = OrderItem::where('supplier_id', auth()->user()->supplier->id)
            ->whereHas('order', function($q) use($filiale_id){
                return $q->where('filiale_id', $filiale_id);
            })
            ->orderby('created_at','desc')->paginate(15);*/

            $bats = Bat::wherehas('order',function($q) use($supplier_id,$filiale_id){
                return $q->whereHas('order',function($d) use($filiale_id){
                    return $d->where('filiale_id', $filiale_id);
                })->where('supplier_id',$supplier_id);
            })->paginate(15);
        }else{
           // $orders = OrderItem::where('supplier_id', auth()->user()->supplier->id)->orderby('created_at','desc')->paginate(15);
            $bats = Bat::wherehas('order',function($q) use($supplier_id){
                return $q->where('supplier_id',$supplier_id);
            })->paginate(15);
        }
        
        $filiale = Filiale::find($filiale_id) ?? new Filiale();
        return view('supplier.bat')->with( compact('filiales', 'bats', 'filiale') );
    }

    public function display(OrderItem $orderitem, Request $request){

        if($request->isMethod("POST")){
            $user = auth()->user();
            $email = $orderitem->order->user->email;

            Comment::create([
                'type' => 'bat',
                'type_id' => $orderitem->id,
                'comment' => $request->get('comment'),
                'user_id' => $user->id,
            ]);

            
            $link = route('supplier.bat.display',$orderitem);
            $detail = [
                'title' => __('email.comment_title'),
                'header' => __('email.comment'),
                'link' => $link,
                'body' => __('email.comment_body', ['item' => 'BAT '.$orderitem->product_name,'user'=>$user->supplier->company,'link'=>$link]),
                'btn' => __('common.comment_btn')
            ];
            \Mail::to($email)->send(new \App\Mail\Comment($detail));

            return redirect()->back()->with('success', __('common.commented'));
        }

        $documents = Document::where('type_id', $orderitem->bat->id)->where('type','bat')
        ->where('type','bat')->get()->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->created_at)->format('d-m-Y - H:i');
        });
        $messages = Comment::where('type','bat')->where('type_id',$orderitem->id)->orderby('created_at','desc')->paginate(20);

        return view('supplier.bat_detail')->with( compact('orderitem','messages','documents') );
    }

    /**
     * Add a BAT in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        $bat = Bat::find($request->get('bat'));
        foreach($request->file()['files'] as $file){
            $path = $file->store('bats/' . date("Ymd"));

            Document::create([
                'path' => $path,
                'mime' => $file->getMimeType(),
                'name' => $file->getClientOriginalName(),
                'status' => 'approuved',
                'type_id' => $request->get('bat'),
                'type' => 'bat'
            ]);
        }

        $bat->update(['status'=>'pending']);

        return redirect()->back()->with('success', __('common.created'));
    }

    public function download(Document $document){
        return \Storage::download($document->path, $document->name);
    }
}