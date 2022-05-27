<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Catalog;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class CatalogController extends Controller
{
    //
    public function index(Request $request, Catalog $catalog){
        if($request->isMethod("POST")){
            $validate=Validator::make($request->all(), [
                'name' =>'required',
                'ref_catalog' => 'required|unique:catalogs,ref_catalog',
                'type' => 'required',
                'upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            ]);

            if($validate->fails()){
                $errors ="<ul>";
                foreach($validate->errors()->all() as $error){
                    $errors .="<li>" . $error . "</li>";
                }
                $errors .="</ul>";
                return redirect()->back()->with('error', $errors);
            }

            $path = $request->file('upload')->store('catalogs/' . date("Ymd"));

            $params = $request->all();
            $catalogSave = Catalog::create([
                'name'=>$request->name,
                'ref_catalog' => $request->ref_catalog,
                'type' => $request->type,
                'path' => $path,
                'supplier_id' => Auth::user()->Supplier->id,
                'filiale_id' => 1,
                'user_id' => Auth::user()->id
            ]);

            // Send Email to all admins
            $admin = User::select('email')->where('role', '=', 'admin')->get()->all();

            try{
                Mail::to($admin)->send(new \App\Mail\CatalogNotification($catalogSave));
            } catch(IException $o) {
                // Laravel::log();
            }
            return redirect()->route('supplier.catalogs')->with('success', __('common.created'));
        
        }

        $catalogs = Catalog::where("supplier_id", Auth::user()->Supplier->id)->paginate(20);
        return view('supplier.catalog')->with( compact('catalogs', 'catalog') );
    }

    /**
     * Update a catalog in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $filiale, Request $request){

        if($request->isMethod('POST')){
                
            $this->validate($request, [
                'name' => 'required',
                'status' => 'required|boolean',
            ]);

            $params = $request->all();
            $filiale->update($params);

            return redirect()->route('admin.catalogs')->with('success', __('common.updated'));
        }else{
                $title = __('admin/setting.edit_catalog');

        return view('supplier.catalog')->with( compact('filiale','title') );
        }
    }

    /**
     * Remove a catalog from the viewable list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Catalog $catalog){

        //$catalog->status = false;
        $catalog->delete();

        return redirect()->route('supplier.catalogs')->with('success', __('common.deleted'));
    }

}