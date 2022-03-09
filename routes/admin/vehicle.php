<?php 

use App\Http\Controllers\Admin\VehicleController;
use Illuminate\Support\Facades\Route;


    Route::group(['prefix'=>'/admin/vehicle','as'=>'admin.vehicle.'], function(){
        Route::get('/', [VehicleController::class, 'vehicle']) 
        ->name('as');

        /////////////////////////////////
        /////////// Vehicle /////////////
        /////////////////////////////////
        Route::get('/', [VehicleController::class, 'vehicle']) 
        ->name('vehicle');

        //  register new vehicle - vehicle
        Route::get('/register_new_vehicle', [VehicleController::class, 'register_new_vehicle']) 
        ->name('register_new_vehicle');

        // own new vehicle - vehicle

        Route::post('own_new_vehicle', [VehicleController::class, 'own_new_vehicle']) 
        ->name('own_new_vehicle');     

        Route::post('/register_new_vehicle/add_own_new_vehicle', [VehicleController::class, 'add_own_new_vehicle']) 
        ->name('register_new_vehicle.add_own_new_vehicle');

        Route::get('/register_new_vehicle/add_hired_sub_contractor_vehicle', [VehicleController::class, 'add_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.add_hired_sub_contractor_vehicle');

        Route::post('view_vehicle', [VehicleController::class, 'view_vehicle']) 
        ->name('view_vehicle');



        Route::get('/edit_hired_sub_contractor_vehicle', [VehicleController::class, 'edit_hired_sub_contractor_vehicle']) 
        ->name('edit_hired_sub_contractor_vehicle');

        Route::post('/edit_own_new_vehicle', [VehicleController::class, 'edit_own_new_vehicle']) 
        ->name('edit_own_new_vehicle');

        Route::get('/register_new_vehicle/readings/update_fuel_reading', [VehicleController::class, 'update_fuel_reading']) 
        ->name('fuel.readings.update_fuel_reading');



        Route::post('/register_new_vehicle/edit_own_vehicle', [VehicleController::class, 'edit_own_vehicle']) 
        ->name('register_new_vehicle.edit_own_vehicle');

        Route::post('/register_new_vehicle/edit_hired_sub_contractor_vehicle', [VehicleController::class, 'edit_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.edit_hired_sub_contractor_vehicle');


        Route::post('/register_new_vehicle/view_own_vehicle', [VehicleController::class, 'view_own_vehicle']) 
        ->name('register_new_vehicle.view_own_vehicle');

        Route::post('/register_new_vehicle/view_hired_sub_contractor_vehicle', [VehicleController::class, 'view_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.view_hired_sub_contractor_vehicle');


        Route::get('/register_new_vehicle/trash_register_new_vehicle', [VehicleController::class, 'trash_register_new_vehicle']) 
        ->name('register_new_vehicle.trash_register_new_vehicle');
        
        Route::get('/register_new_vehicle/register_new_vehicle_history', [VehicleController::class, 'register_new_vehicle_history']) 
        ->name('register_new_vehicle.register_new_vehicle_history');

        Route::post('/save_hired_sub_contractor_vehicle', [VehicleController::class, 'save_hired_sub_contractor_vehicle']) 
        ->name('save_hired_sub_contractor_vehicle');

        Route::post('/new_truck', [VehicleController::class, 'save_truck_type']) 
        ->name('save_vehicle_new_truck_type');

        Route::post('/new_pickup', [VehicleController::class, 'save_pickup_type']) 
        ->name('save_vehicle_new_pickup_type');

    });

?>