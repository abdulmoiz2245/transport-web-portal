<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InventoryController as Admin_InventoryController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\InventoryController;



use Illuminate\Support\Facades\Route;

    Route::get('/employee/inventory', [InventoryController::class, 'inventory']) 
    ->name('user.inventory');
    
    Route::group(['prefix'=>'/employee/inventory','as'=>'user.inventory.'], function(){

        /////////////////////////////////
        ///////// inventory /////////
        /////////////////////////////////
        Route::get('/inventory', [InventoryController::class, 'inventory']) 
        ->name('inventory');
        

        Route::post('/purchase/view', [InventoryController::class, 'view_purchase']) 
        ->name('view_purchase');

        Route::get('/purchase/history', [InventoryController::class, 'purchase_history']) 
        ->name('purchase_history');

        Route::post('/purchase/history/clear', [InventoryController::class, 'purchase_history_clear']) 
        ->name('purchase_history_clear');

        Route::get('/purchase/add', [InventoryController::class, 'add_purchase']) 
        ->name('add_purchase');

        Route::post('/purchase/edit', [InventoryController::class, 'edit_purchase']) 
        ->name('edit_purchase');

        Route::post('/purchase/update', [InventoryController::class, 'update_purchase']) 
        ->name('update_purchase');

        Route::post('/purchase/delete', [InventoryController::class, 'delete_purchase']) 
        ->name('delete_purchase');

        Route::post('/purchase/save', [InventoryController::class, 'save_purchase']) 
        ->name('save_purchase');

    });

?>