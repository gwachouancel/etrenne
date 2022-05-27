<?php

use App\Http\Controllers\Supplier\BATController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supplier\CatalogController;
use App\Http\Controllers\Supplier\OrderController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Supplier\ProfileController;
use App\Http\Controllers\Supplier\DashboardController;
use App\Http\Controllers\Supplier\DocumentController;
use App\Models\Document;
use App\Models\Catalog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::prefix('supplier')->group( function () {

        Route::get('/', function () {
            return redirect()->route('supplier.dashboard');
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('supplier.dashboard');
    
        Route::get('profile', [ProfileController::class, 'profile'])->name('supplier.profile');

        // Catalogs - Catalogue
        Route::prefix('catalogs')->group(function () {
            Route::match(['GET','POST'], '/', [CatalogController::class, 'index'])->name('supplier.catalogs');
            // Route::match(['GET','POST'], 'new', [CatalogController::class, 'new'])->name('supplier.catalog.new');
            Route::match(['GET','POST'], 'edit/{permission}', [CatalogController::class, 'edit'])->name('supplier.catalog.edit');
            Route::get('delete/{catalog?}', [CatalogController::class, 'delete'])->name('supplier.catalog.delete');
            Route::get('{catalog?}', function(Catalog $catalog) {
                return Storage::download($catalog->path, $catalog->ref_catalog . $catalog->name . ".pdf");
            })->name('supplier.catalog.download');
        });

        // BAT - Bon à tirer
        Route::prefix('bats')->group(function () {
            Route::match(['GET','POST'], '/', [BatController::class, 'index'])->name('supplier.bats');
            Route::match(['GET','POST'],'/display/{orderitem}', [BatController::class, 'display'])->name('supplier.bat.display');
            Route::post('/file/add', [BatController::class, 'new'])->name('supplier.batfile.add');
            Route::get('download/{document}',[BatController::class, 'download'])->name('supplier.bat.download');
        });


		Route::match(['get','post'], 'profile', [ProfileController::class, 'profile'])->name('supplier.profile');

        // Orders - Commandes
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('supplier.orders');
            Route::get('/display/{order?}', [OrderController::class, 'display'])->name('supplier.order.display');
            Route::get('/download/{order?}', [OrderController::class, 'download'])->name('supplier.order.download');
        });

        // Ajax request
        Route::prefix('json')->group(function(){
            Route::match(['GET', 'POST'], '/order/status/{order}', [OrderController::class, 'getOrderStatus'])->name('supplier.order.status');
        });

        // Messages
        Route::prefix('messages')->group(function () {
            Route::post('/{order?}', [OrderController::class, 'message'])->name('supplier.message.submit');
        });
 
        // Documents
        Route::prefix('documents')->group(function() {
            Route::get('expeditions', [DocumentController::class, 'expedition'])->name('supplier.expeditions');
            Route::match(['GET', 'POST'], 'expedition/document/{filiale?}', [DocumentController::class, 'expedition_detail'])->name('supplier.expedition.detail');

            Route::post('expedition/documents/filiale', [DocumentController::class, 'getDocumentsByFiliale'])->name('supplier.document.filiale');
        
            Route::get('expedition/document/delete/{doc?}', [DocumentController::class, 'delete'])->name('supplier.expedition.delete');
            Route::get('expedition/document/update/{doc?}', [DocumentController::class, 'update'])->name('supplier.expedition.update');
            Route::post('expedition/documents/upload', [DocumentController::class, 'uploadFile'])->name('supplier.expedition.upload');
            Route::get('expedition/download/{filiale}', [DocumentController::class, 'getAllExpeditionZip'])->name('supplier.expedition.downloadzip');

            // Bills
            Route::get('bills', [DocumentController::class, 'bills'])->name('supplier.bills');
            Route::get('bill/document/delete/{doc?}', [DocumentController::class, 'delete'])->name('supplier.bill.delete');
            Route::get('bill/document/update/{doc?}', [DocumentController::class, 'uploadBillFile'])->name('supplier.bill.update');
            Route::post('bill/documents/upload', [DocumentController::class, 'uploadBillFile'])->name('supplier.bill.upload');
            Route::post('bill/global/documents/upload', [DocumentController::class, 'uploadGlobalBillFile'])->name('supplier.globalbill.upload');

            Route::get('bill/alldownload/{supplier}', [DocumentController::class, 'getGlobalBillsBySupplierZip'])->name('supplier.globalbills.downloadzip');
        
        });
    });