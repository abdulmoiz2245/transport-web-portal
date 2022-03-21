<?php 

use App\Http\Controllers\Admin\WorkshopController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'/admin/workshop','as'=>'admin.workshop.'], function(){
    Route::get('/', [WorkshopController::class, 'workshop']) 
    ->name('as');

    /////////////////////////////////
    /////////// Vehicle /////////////
    /////////////////////////////////
    Route::get('/', [WorkshopController::class, 'workshop']) 
    ->name('workshop');
    
});