<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bat;
use App\Models\Filiale;
use App\Models\Supplier;
use App\Models\Comment;
use App\Models\Document;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class BatController extends Controller
{
    //

    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        $supplier_id = $request->get('supplier');

        if( $supplier_id && $request->isMethod('post')  ){
            $bats = Bat::wherehas('order',function($q) use($supplier_id){
                return $q->where('supplier_id',$supplier_id);
            })->paginate(15);
        }else{
            $bats = Bat::paginate(15);
        }
        
        $supplier = Supplier::find($supplier_id) ?? new Supplier();
        return view('admin.bat')->with( compact('bats', 'suppliers','supplier') );
    }

    public function display(OrderItem $orderitem, Request $request){
        
        if($request->isMethod("POST")){
            $user = auth()->user();
            $email = $orderitem->supplier->user->email;

            Comment::create([
                'type' => 'bat',
                'type_id' => $orderitem->id,
                'comment' => $request->get('comment'),
                'user_id' => $user->id,
            ]);

            $link = route('admin.bat.display',$orderitem);
            $detail = [
                'title' => __('email.comment_title'),
                'header' => __('email.comment'),
                'link' => $link,
                'body' => __('email.comment_body', ['item' => 'BAT '.$orderitem->product_name,'user'=>$user->name,'link'=>$link]),
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

        return view('admin.bat_detail')->with( compact('orderitem','messages','documents') );
    }

    public function decide(Bat $bat,$decision){

        if( in_array($decision,['approuved','rejected']) ){
            $bat->update(['status' => $decision]);
            $bat->document->update(['status' => $decision]);
            
            return redirect()->route('admin.bats')->with('success', __('common.updated'));
        }else
        return redirect()->back()->with('error', __('common.error'));
    }

    public function download(Document $document){
        return \Storage::download($document->path, $document->name);
    }

}
