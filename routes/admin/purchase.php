<?php 

use App\Http\Controllers\Admin\PurchaseController;
use Illuminate\Support\Facades\Route;


    Route::group(['prefix'=>'/admin/purchase','as'=>'admin.purchase.'], function(){
        Route::get('/', [PurchaseController::class, 'purchase']) 
        ->name('as');

        /////////////////////////////////
        ///////// Purchase /////////
        /////////////////////////////////
        Route::get('/purchase', [PurchaseController::class, 'purchase']) 
        ->name('purchase');

        Route::get('/purchase/history', [PurchaseController::class, 'purchase_history']) 
        ->name('purchase_history');

        Route::post('/purchase/history/clear', [PurchaseController::class, 'purchase_history_clear']) 
        ->name('purchase_history_clear');

        Route::post('/purchase/view', [PurchaseController::class, 'view_purchase']) 
        ->name('view_purchase');

        Route::post('/purchase/vehicle/view', [PurchaseController::class, 'view_vehicle_purchase']) 
        ->name('view_vehicle_purchase');

        Route::get('/purchase/add', [PurchaseController::class, 'add_purchase']) 
        ->name('add_purchase');

        Route::get('/purchase/vehicle/add', [PurchaseController::class, 'add_vehicle_purchase']) 
        ->name('add_vehicle_purchase');

        Route::post('/purchase/edit', [PurchaseController::class, 'edit_purchase']) 
        ->name('edit_purchase');
        Route::post('/purchase/vehicle/edit', [PurchaseController::class, 'edit_vehicle_purchase']) 
        ->name('edit_vehicle_purchase');

        Route::post('/purchase/update', [PurchaseController::class, 'update_purchase']) 
        ->name('update_purchase');

        Route::post('/purchase/vehicle/update', [PurchaseController::class, 'update_vehicle_purchase']) 
        ->name('update_vehicle_purchase');

        Route::post('/purchase/delete', [PurchaseController::class, 'delete_purchase']) 
        ->name('delete_purchase');

        Route::post('/purchase/vehicle/delete', [PurchaseController::class, 'delete_vehicle_purchase']) 
        ->name('delete_vehicle_purchase');

        Route::get('/purchase/trash', [PurchaseController::class, 'trash_purchase']) 
        ->name('trash_purchase');
        
        Route::get('/purchase/vehicle/trash', [PurchaseController::class, 'trash_vehicle_purchase']) 
        ->name('trash_vehicle_purchase');

        Route::post('/purchase/restor-delete', [PurchaseController::class, 'restore_purchase']) 
        ->name('restore_purchase');

        Route::post('/purchase/vehicle/restor-delete', [PurchaseController::class, 'restore_vehicle_purchase']) 
        ->name('restore_vehicle_purchase');

        Route::post('/purchase/delete-status', [PurchaseController::class, 'delete_purchase_status']) 
        ->name('delete_purchase_status');

        Route::post('/purchase/vehicle/delete-status', [PurchaseController::class, 'delete_vehicle_purchase_status']) 
        ->name('delete_vehicle_purchase_status');

        Route::post('/purchase/save', [PurchaseController::class, 'save_purchase']) 
        ->name('save_purchase');

        Route::post('/purchase/vehicle/save', [PurchaseController::class, 'save_vechicle_purchase']) 
        ->name('save_vechicle_purchase');

        Route::get('/purchase/get_purchase_vehicle', [PurchaseController::class, 'get_purchase_vehicle']) 
        ->name('get_purchase_vehicle');

    });

?>