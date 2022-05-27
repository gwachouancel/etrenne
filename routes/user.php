<?php

use App\Models\Catalog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BatController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\MarketPlaceController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\DocumentController;
// use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Web Routes for User
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group( function () {

    // Orders - Commandes
    Route::prefix('orders')->group(function () {
        Route::match(['GET', 'POST'], '/form', [OrderController::class, 'index'])->name('user.orders');
        Route::match(['GET','POST'], 'new', [OrderController::class, 'new'])->name('user.order.new');
        Route::match(['GET','POST'], '/display/{order}', [OrderController::class, 'display'])->name('user.order.display');
        Route::get('/order/download/{order?}', [OrderController::class, 'download'])->name('user.order.download');
        Route::match(['GET', 'POST'], '/edit/{order?}/item/{orderitem?}', [OrderController::class, 'edit'])->name('user.order.orderitem');
        Route::get('/order/item/delete/{orderitem?}', [OrderController::class, 'delete'])->name('user.orderitem.delete');
    
        Route::post('supplier/catalog', [OrderController::class, 'getCatalogBySupplier'])->name('user.getsuppliercatalogs');
    });

    Route::prefix('suppliers')->group(function () {
        //Route::get('display/{supplier}',[SupplierController::class, 'display'] )->name('admin.supplier.display');
        Route::get('display/{supplier}/filiale/{filiale}',[SupplierController::class, 'filiale'] )->name('admin.supplier.filiale');
    });

    // Messages
    Route::prefix('messages')->group(function () {
        Route::post('/{order?}', [OrderController::class, 'message'])->name('user.message.submit');
    });

    Route::prefix('marketplace')->group(function () {
        Route::get('/', [MarketPlaceController::class, 'index'])->name('admin.marketplace');
        Route::get('download/{catalog?}', function(Catalog $catalog) {
            return Storage::download($catalog->path, $catalog->ref_catalog . $catalog->name . ".pdf");
        })->name('admin.catalog.download');
    });

});

Route::prefix('user')->group( function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
    Route::prefix('bats')->group(function () {
        Route::match(['GET','POST'],'/', [BatController::class, 'index'])->name('user.bats');
    });

    Route::prefix('documents')->group(function(){
        Route::get('expeditions', [DocumentController::class, 'expeditions'])->name('user.documents.expeditions');
        Route::get('expeditions/download/{document?}', [DocumentController::class, 'download'])->name('user.expeditions.download');
    
        // Bills
        Route::get('bills', [DocumentController::class, 'bills'])->name('user.all.bills');
    });
});