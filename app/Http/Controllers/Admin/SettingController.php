<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filiale;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Setting shipping document
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(Request $request, $status = null)
    {
        if($status != null){
            Setting::where('slug','platform')
            ->update([
                'data' => $status,
            ]);

            if(Setting::where('slug','platform')->first()->data){
                Artisan::call('migrate:fresh --seed');
                $msg = 'admin/setting.platform_opened';
            }else{
                Artisan::call('snapshot:create');
                $msg = 'admin/setting.platform_restricted';
            }

            return redirect()->route('admin.dashboard')->with('success', __($msg));
        }

        if(Setting::where('slug','platform')->first()->data){
            $view = 'admin.setting.close_app';}
        else
            $view = 'admin.setting.open_app';

        return view($view);
    }

    /**
     * Setting shipping document
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function currency(Request $request)
    {
        if($request->isMethod('POST')) {

            $this->validate($request, [
                'currency' => 'required|in:EUR,XAF,XOF',
            ]);

            Setting::where('slug','currency')
            ->update([
                'data' => $request->currency,
            ]);

            return redirect()->route('admin.setting.currency')->with('success', __('common.updated'));
        }

        $currency = Setting::where('slug', 'currency')->first()->data;

        return view('admin.setting.currency')->with(compact('currency'));
    }

    /**
     * Setting shipping document
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function document(Request $request)
    {
        if($request->isMethod('POST')) {

            $request->validate([
                'data' => 'required',
                'subsidary' => 'required|exists:filiales,id'
            ]);

            Setting::create([
                'slug' => 'document',
                'data' => $request->data,
                'subsidary' => $request->subsidary
            ]);
        }

        // Get all active subsidaries
        $subsidaries = Filiale::where('status', true)->get();

        // Get all shipping documents
        $documents = Setting::where('slug', '=', 'document')->paginate(10);

        $setting = new Setting();

        return view('admin.document_setting')->with(compact('setting', 'documents', 'subsidaries'));
    }

    /**
     * Update document expediction in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Setting $setting) {

        if($request->isMethod('POST')) {

            $request->validate([
                'data' => 'required',
                'subsidary' => 'required|exists:filiales,id'
            ]);

            $setting->update($request->all());

            return redirect()->route('admin.setting.document')->with('success', __('common.updated'));
        } else {
            $subsidaries = Filiale::where('status', true)->get();
            $documents = Setting::where('slug', '=', 'document')->paginate(10);
            return view('admin.document_setting')->with( compact('setting', 'subsidaries', 'documents'));
        }
    }

    /**
     * Delete a shipping document from the application
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(Setting $setting){
        $setting->delete();
        return redirect()->route('admin.setting.document')->with('success', __('common.deleted'));
    }

    public function delay(Request $request){

        if( $request->isMethod('get')){
            $date = Setting::where('slug','date')->first();
            $delay = Setting::where('slug','delay')->first();

            return view('admin.setting.delay')->with( compact('delay','date') );
        }

        $this->validate($request, [
            'delay' => 'required|integer',
            'date' => 'required|date',
        ]);

        Setting::where('slug', 'delay')->update(['data'=>$request->get('delay')]);
        Setting::where('slug', 'date')->update(['data'=>$request->get('date')]);
        
        return redirect()->back()->with('success', __('common.updated'));
    }
}
