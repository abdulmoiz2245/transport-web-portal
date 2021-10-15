<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\Sub_contractorController ;

use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;

Route::middleware(['auth:user'])->group(function () {
    Route::get('/employee/sub-contractor', [  Sub_contractorController::class, 'sub_contractor']) 
    ->name('user.sub_contractor');
    Route::group(['prefix'=>'/employee/sub_contractor','as'=>'user.sub_contractor.'], function(){
        // Route::get('/', [  Sub_contractorController::class, 'sub_contractor']) 
        // ->name('sub_contractor');

        Route::get('/add-department', [  Sub_contractorController::class, 'add_department']) 
        ->name('add_department');

        // Route::post('/save-company', [  Sub_contractorController::class, 'save_department']) 
        // ->name('save_department');
    
        Route::post('/view', [  Sub_contractorController::class, 'view_sub_contractor']) 
        ->name('view_sub_contractor');
    
        Route::get('/add', [  Sub_contractorController::class, 'add_sub_contractor']) 
        ->name('add_sub_contractor');
    
        Route::post('/edit', [  Sub_contractorController::class, 'edit_sub_contractor']) 
        ->name('edit_sub_contractor');

        Route::post('/edit-sub_contractor-rate-card', [  Sub_contractorController::class, 'edit_rate_card']) 
        ->name('edit_rate_card');
    
        Route::post('/sub_contractor-info/update', [  Sub_contractorController::class, 'update_sub_contractor_info']) 
        ->name('update_sub_contractor_info');
    
        Route::post('/sub_contractor-department/update', [  Sub_contractorController::class, 'update_sub_contractor_department']) 
        ->name('update_sub_contractor_department');
    
        Route::post('/sub_contractor-rate-card/update', [  Sub_contractorController::class, 'update_sub_contractor_rate_card']) 
        ->name('update_sub_contractor_rate_card');
    
        Route::post('/sub_contractor-info/save', [  Sub_contractorController::class, 'save_sub_contractor_info']) 
        ->name('save_sub_contractor_info');
    
        Route::post('/sub_contractor-department/save', [  Sub_contractorController::class, 'save_sub_contractor_department']) 
        ->name('save_sub_contractor_department');
    
        Route::post('/sub_contractor-rate-card/save', [  Sub_contractorController::class, 'save_sub_contractor_rate_card']) 
        ->name('save_sub_contractor_rate_card');
    
        Route::post('/delete', [  Sub_contractorController::class, 'delete_sub_contractor']) 
        ->name('delete_sub_contractor');
    
        Route::get('/history', [  Sub_contractorController::class, 'sub_contractor_history']) 
        ->name('sub_contractor_history');
        
        Route::post('/table-history/clear', [  Sub_contractorController::class, 'table_history_clear']) 
        ->name('table_history_clear');

        //

        Route::get('/sub_contractor-rate-card/{id}/', [  Sub_contractorController::class, 'sub_contractor_rate_card']) 
        ->name('sub_contractor_rate_card');

        Route::get('/sub_contractor-rate-card/add/{id}', [  Sub_contractorController::class, 'sub_contractor_rate_card_add']) 
        ->name('sub_contractor_rate_card_add');

        Route::post('/sub_contractor-rate-card/edit', [  Sub_contractorController::class, 'edit_sub_contractor_rate_card']) 
        ->name('edit_sub_contractor_rate_card');

        Route::post('/sub_contractor-rate-card/delete', [  Sub_contractorController::class, 'delete_sub_contractor_rate_card']) 
        ->name('delete_sub_contractor_rate_card');

        Route::post('/new-department', [  Sub_contractorController::class, 'save_department']) 
        ->name('save_sub_contractor_new_department');

        // Route::post('/sub_contractor-rate-card/restor-delete', [  Sub_contractorController::class, 'restore_sub_contractor_rate_card']) 
        // ->name('restore_sub_contractor_rate_card');

        // Route::post('/sub_contractor-rate-card/delete-status', [  Sub_contractorController::class, 'delete_sub_contractor_rate_card_status']) 
        // ->name('delete_sub_contractor_rate_card_status');

        Route::post('/sub-contrator-rate-card/get-customer-rate-card', [Sub_contractorController::class, 'get_customer_rate_card']) 
        ->name('get_customer_rate_card');

        Route::post('/new-department', [Sub_contractorController::class, 'save_department']) 
        ->name('save_sub_contractor_new_department');
    });

});

?>