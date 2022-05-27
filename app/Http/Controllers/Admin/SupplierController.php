<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Filiale;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{

    /**
     * Display a listing of all the available suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderby('created_at','desc')->paginate(10);

        return view('admin.accounts')->with( compact('suppliers') );
    }


    /**
     * Add a supplier in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        if($request->isMethod('GET')){
            $user = new User();
            $user->status = 'active';
            $title = __('admin/setting.add_supplier');
            $filiales = Country::all();

            return view('admin.supplier')->with( compact('user', 'title', 'filiales') );
        }

        $this->validate($request, [
                'name' => 'required',
                'lastname' => 'required',
                'address' => 'required',
                'company' => 'required',
                'email' => 'required|email|unique:users,email',
                'country' => 'required|exists:countries,code',
                'product_type' => 'required|in:agenda,gift',
                'status' => 'required|in:active,inactive',
                'phone' => 'required',
                //'rib' => 'required',
            ]
        );

        $params = $request->all();
        $params['token'] = hash('sha256', Str::random(50));
        $user = User::create($params);

        $file = $request->file('rib');
        $filename = '';
        if($file){
            $path = $file->store('rib/' . date("Ymd"));
            $filename = $file->getClientOriginalName();

            $doc=Document::create([
                'path' => $path,
                'mime' => $file->getMimeType(),
                'name' => $filename,
                'status' => 'approuved',
                'type_id' => $user->id,
                'type' => 'rib'
            ]);
        }

        Supplier::create([
            'user_id' => $user->id,
            'company' => $request->company,
            'address' => $request->address,
            'country' => $request->country,
            'product_type' => $request->product_type,
            'rib' => $filename
        ]);

        $detail = [
            'title' => __('email.set_pwd'),
            'body' => __('email.set_pwd_msg'),
            'link' => route('password.confirm', $user->id),
            'user' => $user->fullname,
        ];
       
        Mail::to($request->email)->send(new \App\Mail\Password($detail));

        return redirect()->route('admin.accounts')->with('success', __('common.created'));
    }

    /**
     * Update a supplier in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request){

		if($request->isMethod('POST')){
            
        $this->validate($request, [
                'name' => 'required',
                'lastname' => 'required',
                'address' => 'required',
                'company' => 'required',
                'email' => 'required|email',
                'country' => 'required|exists:countries,code',
                'product_type' => 'required|in:agenda,gift',
                'status' => 'required|in:active,inactive',
                'phone' => 'required',
                //'rib' => 'required',
            ]
        );
            
            $params = $request->all();
            $user->update($params);

            $file = $request->file('rib');
            if($file){
                $path = $file->store('rib/' . date("Ymd"));
    
                $doc=Document::create([
                    'path' => $path,
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                    'status' => 'approuved',
                    'type_id' => $user->id,
                    'type' => 'rib'
                ]);
                $params['rib'] =  $file->getClientOriginalName();
            }else{
                $params['rib'] = $user->supplier->rib;
            }

            $supplier = $user->Supplier;
            $supplier->update($params);

            return redirect()->route('admin.accounts')->with('success', __('common.updated'));
		}else{
            $title = __('admin/setting.edit_supplier');
            $filiales = Country::all();

			return view('admin.supplier')->with( compact('user','title', 'filiales') );
		}
    }

    /**
     * Remove a supplier from the viewable list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user){

        $user->update(['status' => 'deleted']);

        return redirect()->route('admin.accounts')->with('success', __('common.deleted'));
    }

    public function display(Request $request,Supplier $supplier){

        if($request->supplier_id){
            $supplier = Supplier::find($request->supplier_id);
        }
        $suppliers = Supplier::all();
        $orders = OrderItem::where('supplier_id', $supplier->id)->paginate(20);

        $filiales = Order::whereHas('items', function($q) use($supplier){
            return $q->where('supplier_id', $supplier->id);
        })
        ->paginate(10);
        
        $documents = Document::where('type','expedition')->where('user_id',$supplier->id)->paginate(20);
        $bills = Document::where('type','bill')->where('user_id',$supplier->id)->paginate(20);
        
        return view('admin.supplier_file')->with( compact('supplier','orders','filiales','documents','bills','suppliers') );
    }

    public function filiale(Supplier $supplier,Filiale $filiale){

        $orders = OrderItem::where('supplier_id', $supplier->id)
        ->whereHas('order',function($q) use($filiale){
            return $q->where('filiale_id',$filiale->id);
        })
        ->paginate(20);
        
        return view('admin.supplier_filiale')->with( compact('supplier','filiale','orders') );
    }
}
