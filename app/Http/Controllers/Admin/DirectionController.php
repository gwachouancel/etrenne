<?php

namespace App\Http\Controllers\Admin;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectionController extends Controller
{

    /**
     * Display a listing of all the available directions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::where('status', true)->orderby('created_at','desc')
        ->get();

        return view('admin.directions')->with( compact('directions') );
    }

    /**
     * Add a direction in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        if($request->isMethod('GET')){
            $direction = new Direction();
            $direction->status = true;
            $title = __('admin/setting.add_direction');

            return view('admin.direction')->with( compact('direction', 'title') );
        }

            $this->validate($request, [
                    'name' => 'required',
                    'status' => 'required|boolean',
                    'email' => 'email|unique:directions,email',
                ]
            );

        $params = $request->all();
        Direction::create($params);

        return redirect()->route('admin.directions')->with('success', __('common.created'));
    }

    /**
     * Update a direction in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Direction $direction, Request $request){

		if($request->isMethod('POST')){
            
            $this->validate($request, [
                    'name' => 'required',
                    'status' => 'required|boolean',
                    'email' => 'email',
                ]
            );

            $params = $request->all();
            $direction->update($params);

            return redirect()->route('admin.directions')->with('success', __('common.updated'));
		}else{
            $title = __('admin/setting.edit_direction');

			return view('admin.direction')->with( compact('direction','title') );
		}
    }

    /**
     * Remove a direction from the viewable list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Direction $direction){

        $direction->status = false;
        $direction->save();

        return redirect()->route('admin.directions')->with('success', __('common.deleted'));
    }

}
