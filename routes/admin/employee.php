<?php 

use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'/admin/hr-pro/employee','as'=>'admin.hr_pro.employee'], function(){
    // Route::get('/', [EmployeeController::class, 'employee']) 
    // ->name('as');

    // Route::get('/employee', [EmployeeController::class, 'hr_pro']) 
    // ->name('employee');

});