<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\CustomerController ;

use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;

Route::middleware(['auth:user'])->group(function () {
    Route::get('/employee/customer', [CustomerController::class, 'customer']) 
    ->name('user.customer');
    Route::group(['prefix'=>'/employee/customer','as'=>'user.customer.'], function(){
        // Route::get('/', [CustomerController::class, 'customer']) 
        // ->name('customer');

        Route::get('/add-department', [CustomerController::class, 'add_department']) 
        ->name('add_department');

        Route::post('/save-company', [CustomerController::class, 'save_department']) 
        ->name('save_department');
    
        Route::post('/view', [CustomerController::class, 'view_customer']) 
        ->name('view_customer');
    
        Route::get('/add', [CustomerController::class, 'add_customer']) 
        ->name('add_customer');
    
        Route::post('/edit', [CustomerController::class, 'edit_customer']) 
        ->name('edit_customer');

        Route::post('/edit-customer-rate-card', [CustomerController::class, 'edit_rate_card']) 
        ->name('edit_rate_card');
    
        Route::post('/customer-info/update', [CustomerController::class, 'update_customer_info']) 
        ->name('update_customer_info');
    
        Route::post('/customer-department/update', [CustomerController::class, 'update_customer_department']) 
        ->name('update_customer_department');
    
        Route::post('/customer-rate-card/update', [CustomerController::class, 'update_customer_rate_card']) 
        ->name('update_customer_rate_card');
    
        Route::post('/customer-info/save', [CustomerController::class, 'save_customer_info']) 
        ->name('save_customer_info');
    
        Route::post('/customer-department/save', [CustomerController::class, 'save_customer_department']) 
        ->name('save_customer_department');
    
        Route::post('/customer-rate-card/save', [CustomerController::class, 'save_customer_rate_card']) 
        ->name('save_customer_rate_card');
    
        Route::post('/delete', [CustomerController::class, 'delete_customer']) 
        ->name('delete_customer');
    
        Route::get('/history', [CustomerController::class, 'customer_history']) 
        ->name('customer_history');
        
        Route::post('/table-history/clear', [CustomerController::class, 'table_history_clear']) 
        ->name('table_history_clear');
    });

});

?>