<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filiale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilialeController extends Controller
{

    /**
     * Display a listing of all the available filiales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filiales = Filiale::where('status', true)->orderby('created_at','desc')
        ->get();

        return view('admin.filiales')->with( compact('filiales') );
    }


    /**
     * Add a filiale in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        if($request->isMethod('GET')){
            $filiale = new Filiale();
            $filiale->status = true;
            $title = __('admin/setting.add_filiale');

            return view('admin.filiale')->with( compact('filiale', 'title') );
        }

        $this->validate($request, [
                'name' => 'required',
                'status' => 'required|boolean',
            ]
        );

        $params = $request->all();
        filiale::create($params);

        return redirect()->route('admin.filiales')->with('success', __('common.created'));
    }

    /**
     * Update a filiale in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Filiale $filiale, Request $request){

		if($request->isMethod('POST')){
            
            $this->validate($request, [
                'name' => 'required',
                'status' => 'required|boolean',
            ]
        );

            $params = $request->all();
            $filiale->update($params);

            return redirect()->route('admin.filiales')->with('success', __('common.updated'));
		}else{
            $title = __('admin/setting.edit_filiale');

			return view('admin.filiale')->with( compact('filiale','title') );
		}
    }

    /**
     * Remove a filiale from the viewable list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Filiale $filiale){

        $filiale->status = false;
        $filiale->save();

        return redirect()->route('admin.filiales')->with('success', __('common.deleted'));
    }
}
