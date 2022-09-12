<?php 

use App\Http\Controllers\User\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/employee/workshop', [WorkshopController::class, 'workshop'])->name('user.workshop');



Route::group(['prefix'=>'/employee/workshop','as'=>'user.workshop.'], function(){
    // Route::get('/', [WorkshopController::class, 'workshop']) 
    
    /////////////////////////////////
    /////////// Vehicle /////////////
    /////////////////////////////////
    // Route::get('/job', [WorkshopController::class, 'workshop']);

     //suspension
     Route::get('/job-card', [WorkshopController::class, 'job_card']) 
     ->name('job_card');
 
     Route::get('/job-card/history', [WorkshopController::class, 'job_card_history']) 
     ->name('job_card_history');
 
     Route::post('/job-card/history/clear', [WorkshopController::class, 'job_card_history_clear']) 
     ->name('job_card_history_clear');
 
     Route::get('/job-card/add', [WorkshopController::class, 'add_job_card']) 
     ->name('add_job_card');
 
     Route::post('/job-card/save', [WorkshopController::class, 'save_job_card']) 
     ->name('save_job_card');
 
     Route::post('/job-card/edit', [WorkshopController::class, 'edit_job_card']) 
     ->name('edit_job_card');
 
     Route::post('/job-card/update', [WorkshopController::class, 'update_job_card']) 
     ->name('update_job_card');
 
     Route::post('/job-card/delete', [WorkshopController::class, 'delete_job_card']) 
     ->name('delete_job_card');
 
     Route::get('/job-card/trash', [WorkshopController::class, 'trash_job_card']) 
     ->name('trash_job_card');
 
     Route::post('/job-card/restor-delete', [WorkshopController::class, 'restore_job_card']) 
     ->name('restore_job_card');
 
     Route::post('/job-card/delete-status', [WorkshopController::class, 'delete_job_card_status']) 
     ->name('delete_job_card_status');
 
     Route::post('/job-card/view', [WorkshopController::class, 'view_job_card']) 
     ->name('view_job_card');
 
     Route::get('/vehicle-maintenance', [WorkshopController::class, 'vehicle_maintainace_schedule']) 
     ->name('vehicle_maintainace_schedule');

     Route::get('/vehicle-maintenance/oil-change', [WorkshopController::class, 'vehicle_oil_change_detail']) 
     ->name('vehicle_oil_change_detail');

      //preventive_check_lsit
      Route::get('/preventive-check-list', [WorkshopController::class, 'preventive_check_list']) 
      ->name('preventive_check_list');
  
      Route::get('/preventive-check-list/history', [WorkshopController::class, 'preventive_check_list_history']) 
      ->name('preventive_check_list_history');
  
      Route::post('/preventive-check-list/history/clear', [WorkshopController::class, 'preventive_check_list_history_clear']) 
      ->name('preventive_check_list_history_clear');
  
      Route::get('/preventive-check-list/add', [WorkshopController::class, 'add_preventive_check_list']) 
      ->name('add_preventive_check_list');
  
      Route::post('/preventive-check-list/save', [WorkshopController::class, 'save_preventive_check_list']) 
      ->name('save_preventive_check_list');
  
      Route::post('/preventive-check-list/edit', [WorkshopController::class, 'edit_preventive_check_list']) 
      ->name('edit_preventive_check_list');
  
      Route::post('/preventive-check-list/update', [WorkshopController::class, 'update_preventive_check_list']) 
      ->name('update_preventive_check_list');
  
      Route::post('/preventive-check-list/delete', [WorkshopController::class, 'delete_preventive_check_list']) 
      ->name('delete_preventive_check_list');
  
      Route::get('/preventive-check-list/trash', [WorkshopController::class, 'trash_preventive_check_list']) 
      ->name('trash_preventive_check_list');
  
      Route::post('/preventive-check-list/restor-delete', [WorkshopController::class, 'restore_preventive_check_list']) 
      ->name('restore_preventive_check_list');
  
      Route::post('/preventive-check-list/delete-status', [WorkshopController::class, 'delete_preventive_check_list_status']) 
      ->name('delete_preventive_check_list_status');
  
      Route::post('/preventive-check-list/view', [WorkshopController::class, 'view_preventive_check_list']) 
      ->name('view_preventive_check_list');
     

      Route::get('/vehicle-maintenance-detail', [WorkshopController::class, 'vehicle_maintenance_detail']) 
      ->name('vehicle_maintenance_detail');

    
});