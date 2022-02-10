<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;


Route::middleware(['auth:user'])->group(function () {

    Route::get('/',function (){
      return redirect('/employee');
    });

    Route::get('/employee', [UserController::class, 'dashboard']) 
    ->name('user.dashboard');

    Route::get('/employee/employee', [UserController::class, 'employee']) 
    ->name('user.employee');

    Route::get('/employee/accounts', [UserController::class, 'accounts']) 
    ->name('user.accounts');

    Route::get('/employee/booking', [UserController::class, 'booking']) 
    ->name('user.booking');

    
    require __DIR__.'/customer.php';

    require __DIR__.'/hr_pro.php';

    require __DIR__.'/supplier.php';

    require __DIR__.'/sub_contractor.php';

    require __DIR__.'/purchase.php';

    require __DIR__.'/inventory.php';
    
    require __DIR__.'/operations.php';

    require __DIR__.'/account.php';

    require __DIR__.'/petty.php';
    

    Route::get('/employee/inventory', [UserController::class, 'inventory']) 
    ->name('user.inventory');

    Route::get('/employee/petty-cash', [UserController::class, 'petty_cash']) 
    ->name('user.petty_cash');

    Route::get('/employee/reports', [UserController::class, 'historys']) 
    ->name('user.reports');

    // Route::get('/employee/purchaser', [UserController::class, 'purchaser']) 
    // ->name('user.purchase');

    // Route::get('/employee/sub-contractor', [UserController::class, 'sub_contractor']) 
    // ->name('user.sub_contractors');

    // Route::get('/employee/supplier', [UserController::class, 'supplier']) 
    // ->name('user.supplier');

    Route::get('/employee/vehicles', [UserController::class, 'vehicles']) 
    ->name('user.vehicles');

    Route::get('/employee/workshop', [UserController::class, 'workshop']) 
    ->name('user.workshop');

});

?>