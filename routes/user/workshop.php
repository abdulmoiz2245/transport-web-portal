<?php 

use App\Http\Controllers\User\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/employee/workshop', [WorkshopController::class, 'workshop']) 
    ->name('user.workshop');

// Route::group(['prefix'=>'/employee/workshop','as'=>'user.workshop.'], function(){
//     Route::get('/', [WorkshopController::class, 'workshop']) 
//     ->name('as');

//     /////////////////////////////////
//     /////////// Vehicle /////////////
//     /////////////////////////////////
//     Route::get('/', [WorkshopController::class, 'workshop']) 
//     ->name('workshop');
    
// });