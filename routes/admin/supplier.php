<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SupplierController ;
use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;

    Route::group(['prefix'=>'/admin/supplier','as'=>'admin.supplier.'], function(){
        Route::get('/', [SupplierController::class, 'supplier']) 
        ->name('supplier');

        Route::post('/view', [SupplierController::class, 'view_supplier']) 
        ->name('view_supplier');

        Route::get('/add', [SupplierController::class, 'add_supplier']) 
        ->name('add_supplier');

        Route::get('/get-supplier-products/{id}', [SupplierController::class, 'get_supplier_services_product']) 
        ->name('get_supplier_services_product');

        Route::post('/edit', [SupplierController::class, 'edit_supplier']) 
        ->name('edit_supplier');

        Route::post('/supplier-info/update', [SupplierController::class, 'update_supplier_info']) 
        ->name('update_supplier_info');

        Route::post('/supplier-department/update', [SupplierController::class, 'update_supplier_department']) 
        ->name('update_supplier_department');

        Route::post('/supplier-info/save', [SupplierController::class, 'save_supplier_info']) 
        ->name('save_supplier_info');

        Route::post('/supplier-department/save', [SupplierController::class, 'save_supplier_department']) 
        ->name('save_supplier_department');

  

        Route::post('/delete', [SupplierController::class, 'delete_supplier']) 
        ->name('delete_supplier');

        Route::get('/trash', [SupplierController::class, 'trash_supplier']) 
        ->name('trash_supplier');

        Route::post('/restor-delete', [SupplierController::class, 'restore_supplier']) 
        ->name('restore_supplier');

        Route::post('/delete-status', [SupplierController::class, 'delete_supplier_status']) 
        ->name('delete_supplier_status');

        Route::get('/history', [SupplierController::class, 'supplier_history']) 
        ->name('supplier_history');
        
        Route::post('/table-history/clear', [SupplierController::class, 'table_history_clear']) 
        ->name('table_history_clear');

        Route::post('/new-department', [SupplierController::class, 'save_department']) 
        ->name('save_supplier_new_department');
    });

    

    

?>