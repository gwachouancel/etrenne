<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionMenus;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    /**
     * Display a listing of all the available permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::where('delete', false)->paginate(10);

        return view('admin.permissions')->with( compact('permissions') );
    }

    /**
     * Add a permission in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        if($request->isMethod('GET')){
            $menus = Menu::all();
            $permission = new Permission();
            $permission->status = true;
            $title = __('permission.new');

            return view('admin.permission')->with( compact('menus', 'permission', 'title') );
        }

        $this->validate($request, [
                'code' => 'required|unique:permissions,code',
                'name' => 'required',
                'status' => 'required|boolean',
                'menus.*' => 'distinct|exists:menus,id'
            ],
            [
                'code.exists' => __('common.existing_item', ['item'=> __('common.code')]),
                'menus.*.exists' => __('common.inexisting_item', ['item'=> __('common.menus')]),
            ],
            [
                'code' => __('common.code'),
                'name' => __('common.name'),
                'menus' => __('common.menus'),
            ]
        );

        $params = $request->all();
        $perm = Permission::create($params);

        if(isset($params['menus'])){
            foreach($params['menus'] as  $key => $menuId){
                PermissionMenus::create([
                    'permission_id' => $perm->id,
                    'menu_id' => $menuId
                ]);
            }
        }

        return redirect()->route('admin.permissions')->with('success', __('common.created'));
    }

    /**
     * Update a permission in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission, Request $request){

		if($request->isMethod('POST')){
            
            $this->validate($request, [
                'code' => 'required',
                'name' => 'required',
                'status' => 'required|boolean',
                'menus.*' => 'distinct|exists:menus,id'
            ],
            [
                'code.exists' => __('common.existing_item', ['item'=> __('common.code')]),
                'menus.*.exists' => __('common.inexisting_item', ['item'=> __('common.menus')]),
            ],
            [
                'code' => __('common.code'),
                'name' => __('common.name'),
                'menus' => __('common.menus'),
            ]
        );

            $params = $request->all();
            $permission->update($params);

            PermissionMenus::where('permission_id', $permission->id)->delete();
            if(isset($params['menus'])){
                foreach($params['menus'] as  $key => $menuId){
                    PermissionMenus::create([
                        'permission_id' => $permission->id,
                        'menu_id' => $menuId
                    ]);
                }
            }

            return redirect()->route('admin.permissions')->with('success', __('common.updated'));
		}else{
            $menus = Menu::all();
            $title = __('permission.edit');

			return view('admin.permission')->with( compact('menus','permission','title') );
		}
    }

    /**
     * Remove a permission from the viewable permissions list.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Permission $permission){

        if($permission->id == 1){
            return redirect()->back();
        }

        $permission->delete = true;
        $permission->save();

        return redirect()->route('admin.permissions')->with('success', __('common.deleted'));
    }
}
