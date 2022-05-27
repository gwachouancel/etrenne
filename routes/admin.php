<?php

use App\Http\Controllers\Admin\BatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\FilialeController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DirectionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DocumentController;
use App\Models\Bat;
use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.profile');
    })->name('admin.root');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::match(['get','post'], 'profile', [ProfileController::class, 'profile'])->name('admin.profile');

    Route::get('accounts', [CommonController::class, 'accounts'])->name('admin.accounts');

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permissions');
        Route::match(['GET','POST'], 'new', [PermissionController::class, 'new'])->name('admin.permission.new');
        Route::match(['GET','POST'], 'edit/{permission}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::get('delete/{permission?}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    });

    Route::prefix('directions')->group(function () {
        Route::get('/', [DirectionController::class, 'index'])->name('admin.directions');
        Route::match(['GET','POST'], 'new', [DirectionController::class, 'new'])->name('admin.direction.new');
        Route::match(['GET','POST'], 'edit/{direction}', [DirectionController::class, 'edit'])->name('admin.direction.edit');
        Route::get('delete/{direction?}', [DirectionController::class, 'delete'])->name('admin.direction.delete');
    });

    Route::prefix('filiales')->group(function () {
        Route::get('/', [FilialeController::class, 'index'])->name('admin.filiales');
        Route::match(['GET','POST'], 'new', [FilialeController::class, 'new'])->name('admin.filiale.new');
        Route::match(['GET','POST'], 'edit/{filiale}', [FilialeController::class, 'edit'])->name('admin.filiale.edit');
        Route::get('delete/{filiale?}', [FilialeController::class, 'delete'])->name('admin.filiale.delete');
    });

    Route::prefix('settings')->group(function() {
        Route::match(['GET', 'POST'], 'document', [SettingController::class, 'document'])->name('admin.setting.document');
        Route::match(['GET', 'POST'], 'document/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.document.edit');
        Route::get('document/delete/{setting?}', [SettingController::class, 'delete'])->name('admin.setting.document.delete');

        Route::match(['GET', 'POST'], 'currency', [SettingController::class, 'currency'])->name('admin.setting.currency');
        Route::match(['GET', 'POST'], 'delay', [SettingController::class, 'delay'])->name('admin.setting.delay');
        Route::get('close/{status?}', [SettingController::class, 'close'])->name('admin.setting.close');
    });
    
    Route::prefix('users')->group(function () {
        //Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::match(['GET','POST'], 'new', [UserController::class, 'new'])->name('admin.user.new');
        Route::match(['GET','POST'], 'edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::get('delete/{user?}', [UserController::class, 'delete'])->name('admin.user.delete');
    });

    Route::prefix('suppliers')->group(function () {
        //Route::get('/', [SupplierController::class, 'index'])->name('admin.suppliers');
        Route::match(['GET','POST'], 'new', [SupplierController::class, 'new'])->name('admin.supplier.new');
        Route::match(['GET','POST'], 'edit/{user}', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
        Route::get('delete/{user?}', [SupplierController::class, 'delete'])->name('admin.supplier.delete');
        Route::match(['GET','POST'],'display/{supplier?}',[SupplierController::class, 'display'] )->name('admin.supplier.display');
    });

    Route::prefix('orders')->group(function() {
        Route::get('/all', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('order/{order}/display', [OrderController::class, 'displayByOrder'])->name('admin.byorder.display');
        Route::get('/order/display/{supplier?}', [OrderController::class, 'display'])->name('admin.order.display');
        Route::get('/download/{supplier?}', [OrderController::class, 'download'])->name('admin.order.download');
        Route::get('/download/filiale/{order?}', [OrderController::class, 'downloadPerFiliale'])->name('admin.order.download.filiale');
        //Route::get('/supplier/{supplier?}', [OrderController::class, 'supplier'])->name('admin.supplier.order.display');
        Route::get('/supplier/download/{supplier?}', [OrderController::class, 'supplierDownloadOrder'])->name('admin.supplier.order.download');
        Route::match(['GET', 'POST'], 'filiales/{filiale?}', [OrderController::class, 'filiale'])->name('admin.orders.filiale');
    });

    Route::prefix('bats')->group(function () {
        Route::match(['GET','POST'],'/', [BatController::class, 'index'])->name('admin.bats');
        Route::match(['GET','POST'],'/display/{orderitem}', [BatController::class, 'display'])->name('admin.bat.display');
        Route::get('decide/{bat}/{decission}', [BatController::class, 'decide'])->name('admin.bat.decide');
        Route::get('download/{document}',[BatController::class, 'download'])->name('admin.bat.download');
    });

    Route::prefix('messages')->group(function () {
        Route::post('/{order}', [OrderController::class, 'message'])->name('admin.message.submit');
    });

    Route::prefix('documents')->group(function(){
        Route::get('expedition/supplier/{supplier?}', [DocumentController::class, 'getDocumentExpedition'])->name('admin.expeditions.supplier');
        Route::post('expedition/filiale', [DocumentController::class, 'getDocumentExpeditionByFiliale'])->name('admin.supplier.documents');
        Route::get('expedition/filiale/download/{document}', [DocumentController::class, 'download'])->name('admin.supplier.expedition.download');
    
        Route::match(['GET', 'POST'], 'expeditions/all', [DocumentController::class, 'getAllExpeditions'])->name('admin.documents.expeditions');
        Route::get('expedition/supplier/download/{filiale}', [DocumentController::class, 'getAllExpeditionZip'])->name('admin.expedition.downloadzip');
    
        // Bills
        Route::get('bills', [DocumentController::class, 'bills'])->name('admin.all.bills');
        Route::get('bills/filiale/{filiale}', [DocumentController::class, 'billsByFiliale'])->name('admin.bills.perfiliale');
        Route::match(['GET', 'POST'], 'bills/detail/filiale/{filiale}', [DocumentController::class, 'billsDetailByFiliale'])->name("admin.displaybill.perfiliale");
        Route::get('bills/global/supplier/{supplier}/download', [DocumentController::class, 'globalBillsBySupplier'])->name('admin.supplier.global.bill.download');
        Route::match(['GET', 'POST'], 'bills/global/supplier/{supplier}/display', [DocumentController::class, 'globalBillsDetailBySupplier'])->name('admin.supplier.global.bill.display');

    });

});
