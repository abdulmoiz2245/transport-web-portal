<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PurchaseController as Admin_PurchaseController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PurchaseController;



use Illuminate\Support\Facades\Route;

    Route::get('/employee/purchase', [PurchaseController::class, 'purchase']) 
    ->name('user.purchase');
    
    Route::group(['prefix'=>'/employee/purchase','as'=>'user.purchase.'], function(){

        /////////////////////////////////
        ///////// Purchase /////////
        /////////////////////////////////
        Route::get('/purchase', [PurchaseController::class, 'purchase']) 
        ->name('purchase');
        

        Route::post('/purchase/view', [PurchaseController::class, 'view_purchase']) 
        ->name('view_purchase');

        Route::get('/purchase/history', [PurchaseController::class, 'purchase_history']) 
        ->name('purchase_history');

        Route::post('/purchase/history/clear', [PurchaseController::class, 'purchase_history_clear']) 
        ->name('purchase_history_clear');

        Route::get('/purchase/add', [PurchaseController::class, 'add_purchase']) 
        ->name('add_purchase');

        Route::post('/purchase/edit', [PurchaseController::class, 'edit_purchase']) 
        ->name('edit_purchase');

        Route::post('/purchase/update', [PurchaseController::class, 'update_purchase']) 
        ->name('update_purchase');

        Route::post('/purchase/delete', [PurchaseController::class, 'delete_purchase']) 
        ->name('delete_purchase');

        Route::post('/purchase/save', [PurchaseController::class, 'save_purchase']) 
        ->name('save_purchase');

    });

?>