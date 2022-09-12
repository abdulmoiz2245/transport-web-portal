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

        Route::get('/register-new-vehicle/add-hired-sub-contractor-vehicle', [VehicleController::class, 'add_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.add_hired_sub_contractor_vehicle');

        Route::post('view_vehicle', [VehicleController::class, 'view_vehicle']) 
        ->name('view_vehicle');



       

        Route::post('/edit_own_new_vehicle', [VehicleController::class, 'edit_own_new_vehicle']) 
        ->name('edit_own_new_vehicle');

        Route::get('/register_new_vehicle/readings/update_fuel_reading', [VehicleController::class, 'update_fuel_reading']) 
        ->name('fuel.readings.update_fuel_reading');



        Route::post('/edit_own_new_vehicle', [VehicleController::class, 'edit_own_new_vehicle']) 
        ->name('edit_own_new_vehicle');

        Route::get('/edit_hired_sub_contractor_vehicle', [VehicleController::class, 'edit_hired_sub_contractor_vehicle']) 
        ->name('edit_hired_sub_contractor_vehicle');

  
        Route::post('/register_new_vehicle/edit_hired_sub_contractor_vehicle', [VehicleController::class, 'edit_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.edit_hired_sub_contractor_vehicle');




        Route::post('/save-hired-sub-contractor-vehicle', [VehicleController::class, 'save_hired_sub_contractor_vehicle']) 
        ->name('save_hired_sub_contractor_vehicle');

        Route::post('/new-truck', [VehicleController::class, 'save_truck_type']) 
        ->name('save_vehicle_new_truck_type');

        Route::post('/new-pickup', [VehicleController::class, 'save_pickup_type']) 
        ->name('save_vehicle_new_pickup_type');

        Route::post('/save_vehicle', [VehicleController::class, 'save_vehicle']) 
        ->name('save_vehicle');
        
        Route::post('/update_vehicle', [VehicleController::class, 'update_vehicle']) 
        ->name('update_vehicle');

        Route::get('/fleet/vehicle', [VehicleController::class, 'vehicle_fleet']) 
        ->name('vehicle_fleet');

        Route::get('/fleet/trailer', [VehicleController::class, 'trailer_fleet']) 
        ->name('trailer_fleet');

        // Route::get('/fleet/vehicle/history', [VehicleController::class, 'vehicle_history']) 
        // ->name('vehicle_history');

        // Route::get('/fleet/vehicle/trash', [VehicleController::class, 'trash_vehicle']) 
        // ->name('trash_vehicle');

        // Route::post('/fleet/vehicle/delete', [VehicleController::class, 'delete_vehicle_status']) 
        // ->name('delete_vehicle_status');

        Route::get('/assign/vehicle', [VehicleController::class, 'assign_vehicle']) 
        ->name('assign_vehicle');

        Route::post('/assign/vehicle/save', [VehicleController::class, 'assign_vehicle_save']) 
        ->name('assign_vehicle_save');

        Route::get('/unassign/vehicle/{assign_id}', [VehicleController::class, 'unassign_vehicle']) 
        ->name('unassign_vehicle');

        Route::post('/unassign/vehicle/save', [VehicleController::class, 'unassign_vehicle_save']) 
        ->name('unassign_vehicle_save');

        Route::post('/assign/trailer/save', [VehicleController::class, 'assign_trailer_save']) 
        ->name('assign_trailer_save');

        Route::get('/get-vehicle', [VehicleController::class, 'get_vehicle']) 
        ->name('get_vehicle');

        Route::post('/assign_unassign/vehicle/view', [VehicleController::class, 'view_assigned_unassigned_vehicle']) 
        ->name('view_assigned_unassigned_vehicle');

        Route::post('/assign-unassign/delete', [VehicleController::class, 'delete_assign_unassign_vehicle']) 
        ->name('delete_assign_unassign_vehicle');

        Route::get('/assign_unassign/trash', [VehicleController::class, 'trash_assign_unassign']) 
        ->name('trash_assign_unassign');

        Route::get('/history', [VehicleController::class, 'vehicle_history']) 
        ->name('vehicle_history');

        Route::get('/trash', [VehicleController::class, 'trash_vehicle']) 
        ->name('trash_vehicle');

        Route::post('/vehicle/delete-status', [VehicleController::class, 'delete_vehicle_status']) 
        ->name('delete_vehicle_status');

        Route::post('/vehicle/restore-vehicle', [VehicleController::class, 'restore_vehicle']) 
        ->name('restore_vehicle');

        Route::get('/vehicle/get_vehicle_driver', [VehicleController::class, 'get_vehicle_driver']) 
        ->name('get_vehicle_driver');
    });

?>