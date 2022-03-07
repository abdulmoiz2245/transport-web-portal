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

        // own vehicle - register new vehicle - vehicle
        Route::get('/register_new_vehicle/own_vehicle', [VehicleController::class, 'own_vehicle']) 
            ->name('register_new_vehicle.own_vehicle');

        // hired sub contractor vehicle - register new vehicle - vehicle
        Route::get('/register_new_vehicle/hired_sub_contractor_vehicle', [VehicleController::class, 'hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.hired_sub_contractor_vehicle');

        // registration - register new vehicle - vehicle
        Route::get('/register_new_vehicle/registration', [VehicleController::class, 'registration']) 
        ->name('register_new_vehicle.registration');

        

        Route::get('/register_new_vehicle/add_own_vehicle', [VehicleController::class, 'add_own_vehicle']) 
        ->name('register_new_vehicle.add_own_vehicle');

        Route::get('/register_new_vehicle/add_hired_sub_contractor_vehicle', [VehicleController::class, 'add_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.add_hired_sub_contractor_vehicle');

        Route::get('/register_new_vehicle/add_registration', [VehicleController::class, 'add_registration']) 
        ->name('register_new_vehicle.add_registration');



        Route::post('/register_new_vehicle/readings/save_fuel_reading', [VehicleController::class, 'save_fuel_reading']) 
        ->name('fuel.readings.save_fuel_reading');

        Route::post('/register_new_vehicle/readings/update_fuel_reading', [VehicleController::class, 'update_fuel_reading']) 
        ->name('fuel.readings.update_fuel_reading');



        Route::post('/register_new_vehicle/edit_own_vehicle', [VehicleController::class, 'edit_own_vehicle']) 
        ->name('register_new_vehicle.edit_own_vehicle');

        Route::post('/register_new_vehicle/edit_hired_sub_contractor_vehicle', [VehicleController::class, 'edit_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.edit_hired_sub_contractor_vehicle');

        Route::post('/register_new_vehicle/edit_registration', [VehicleController::class, 'edit_registration']) 
        ->name('register_new_vehicle.edit_registration');



        Route::post('/register_new_vehicle/view_own_vehicle', [VehicleController::class, 'view_own_vehicle']) 
        ->name('register_new_vehicle.view_own_vehicle');

        Route::post('/register_new_vehicle/view_hired_sub_contractor_vehicle', [VehicleController::class, 'view_hired_sub_contractor_vehicle']) 
        ->name('register_new_vehicle.view_hired_sub_contractor_vehicle');

        Route::post('/register_new_vehicle/view_registration', [VehicleController::class, 'view_registration']) 
        ->name('register_new_vehicle.view_registration');



        Route::get('/register_new_vehicle/trash_register_new_vehicle', [VehicleController::class, 'trash_fuel_reading']) 
        ->name('fuel.trash_fuel_reading');
        
        Route::get('/register_new_vehicle/register_new_vehicle_history', [VehicleController::class, 'fuel_reading_history']) 
        ->name('fuel.fuel_reading_history');


        Route::post('/register_new_vehicle/restor-delete', [VehicleController::class, 'restore_fuel_reading']) 
        ->name('fuel.restore_fuel_reading');

        Route::post('/register_new_vehicledelete-status', [VehicleController::class, 'delete_fuel_reading_status']) 
        ->name('fuel.delete_fuel_reading_status');

        //  tyres - inventory

        Route::get('/tyres', [VehicleController::class, 'tyres']) 
        ->name('tyres');

        //  new/used tyres - tyres - inventory
        Route::get('/tyres/new_used_tyres', [VehicleController::class, 'new_used_tyres']) 
        ->name('tyres.new_used_tyres');

        Route::get('/tyres/add_used_tyres', [VehicleController::class, 'add_used_tyres']) 
        ->name('tyres.add_used_tyres');

        Route::post('/tyres/save_used_tyres', [VehicleController::class, 'save_used_tyres']) 
        ->name('tyres.save_new_used_tyres');

        Route::post('/tyres/edit_used_tyres', [VehicleController::class, 'edit_used_tyres']) 
        ->name('tyres.edit_used_tyres');

        Route::post('/tyres/update_used_tyres', [VehicleController::class, 'update_used_tyres']) 
        ->name('tyres.update_new_used_tyres');

        Route::get('/tyres/history', [VehicleController::class, 'tyres_history']) 
        ->name('tyres.tyres_history');
        
        Route::post('/tyres/table-history/clear', [VehicleController::class, 'table_history_clear']) 
        ->name('tyres.table_history_clear');

        Route::post('/tyres/delete-used-tyres-status', [VehicleController::class, 'delete_used_tyres_status']) 
        ->name('tyres.delete_used_tyres_status');

        Route::post('tyres/restore-used-tyres', [VehicleController::class, 'restore_used_tyres']) 
        ->name('restore_used_tyres');

        
        
        Route::get('/tyres/trash_used_tyres', [VehicleController::class, 'trash_used_tyres']) 
        ->name('tyres.trash_used_tyres');

        //  complain tyres - tyres - inventory
        Route::get('/tyres/complain_tyres', [VehicleController::class, 'complain_tyres']) 
        ->name('tyres.complain_tyres');

        Route::get('/tyres/add_complain_tyres', [VehicleController::class, 'add_complain_tyres']) 
        ->name('tyres.add_complain_tyres');

        Route::post('/tyres/save_complain_tyres', [VehicleController::class, 'save_complain_tyres']) 
        ->name('tyres.save_complain_tyres');

        Route::post('/tyres/edit_complain_tyres', [VehicleController::class, 'edit_complain_tyres']) 
        ->name('tyres.edit_complain_tyres');

        Route::post('/tyres/update_complain_tyres', [VehicleController::class, 'update_complain_tyres']) 
        ->name('tyres.update_complain_tyres');

        

        //  tyres entry - tyres - inventory
        Route::get('/tyres/tyres_entry', [VehicleController::class, 'tyres_entry']) 
        ->name('tyres.tyres_entry');

        Route::get('/tyres/add_tyres_entry', [VehicleController::class, 'add_tyres_entry']) 
        ->name('tyres.add_tyres_entry');

        Route::post('/tyres/save_tyres_entry', [VehicleController::class, 'save_tyres_entry']) 
        ->name('tyres.save_tyres_entry');

        Route::post('/tyres/edit_tyres_entry', [VehicleController::class, 'edit_tyres_entry']) 
        ->name('tyres.edit_tyres_entry');

        
        Route::post('/tyres/update_tyres_entry', [VehicleController::class, 'update_tyres_entry']) 
        ->name('tyres.update_tyres_entry');


        //  spare parts - inventory

        Route::get('/spare_parts', [VehicleController::class, 'spare_parts']) 
        ->name('spare_parts');

        //  spare parts in storage - spare parts - inventory
        Route::get('/spare-parts/spare_parts_in_storage', [VehicleController::class, 'spare_parts_in_storage']) 
        ->name('spare_parts.spare_parts_in_storage');

        Route::get('/spare-parts/add_spare_parts_in_storage', [VehicleController::class, 'add_spare_parts_in_storage']) 
        ->name('spare_parts.add_spare_parts_in_storage');

        Route::post('/spare-parts/save_spare_parts_in_storage', [VehicleController::class, 'save_spare_parts_in_storage']) 
        ->name('spare_parts.save_spare_parts_in_storage');

        Route::post('/spare-parts/edit_spare_parts_in_storage', [VehicleController::class, 'edit_spare_parts_in_storage']) 
        ->name('spare_parts.edit_spare_parts_in_storage');

        Route::post('/spare-parts/update_spare_parts_in_storage', [VehicleController::class, 'update_spare_parts_in_storage']) 
        ->name('spare_parts.update_spare_parts_in_storage');

        Route::get('/spare-parts/history', [VehicleController::class, 'spare_parts_history']) 
        ->name('spare_parts.spare_parts_history');
        
        Route::post('/spare-parts/table-history/clear', [VehicleController::class, 'spare_parts_table_history_clear']) 
        ->name('spare_parts.table_history_clear');

        Route::get('/spare-parts/trash', [VehicleController::class, 'spare_parts_trash']) 
        ->name('spare_parts.spare_parts_trash');

        Route::post('/spare-parts/delete-spare-parts-status', [VehicleController::class, 'delete_spare_parts_status']) 
        ->name('spare_parts.delete_spare_parts_status');

        Route::post('spare-parts/restore-spare-parts', [VehicleController::class, 'restore_spare_parts']) 
        ->name('spare_parts.restore_spare_parts');

        //  spare parts entry - spare parts - inventory
        Route::get('/spare_parts/spare_parts_entry', [VehicleController::class, 'spare_parts_entry']) 
        ->name('spare_parts.spare_parts_entry');

        Route::get('/spare_parts/add_spare_parts_entry', [VehicleController::class, 'add_spare_parts_entry']) 
        ->name('spare_parts.add_spare_parts_entry');

        Route::post('/spare_parts/edit_spare_parts_entry', [VehicleController::class, 'edit_spare_parts_entry']) 
        ->name('spare_parts.edit_spare_parts_entry');

        Route::post('/spare_parts/save_spare_parts_entry', [VehicleController::class, 'save_spare_parts_entry']) 
        ->name('spare_parts.save_spare_parts_entry');

        Route::post('/spare_parts/update_spare_parts_entry', [VehicleController::class, 'update_spare_parts_entry']) 
        ->name('spare_parts.update_spare_parts_entry');

        Route::get('/spare-parts/entery/history', [VehicleController::class, 'spare_parts_entry_history']) 
        ->name('spare_parts.spare_parts_entry_history');
        
        // Route::post('/spare-parts/entery/table-history/clear', [VehicleController::class, 'spare_parts_table_history_clear']) 
        // ->name('spare_parts.table_history_clear');

        Route::get('/spare-parts/entery/trash', [VehicleController::class, 'spare_parts_entry_trash']) 
        ->name('spare_parts.spare_parts_entry_trash');

        Route::post('/spare-parts/entery/delete-spare-parts-status', [VehicleController::class, 'delete_spare_parts_entry_status']) 
        ->name('spare_parts.delete_spare_parts_entry_status');

        Route::post('spare-parts/entery/restore-spare-parts', [VehicleController::class, 'restore_spare_parts_entry']) 
        ->name('spare_parts.restore_spare_parts_entry');

        //  tools - inventory

        Route::get('/tools', [VehicleController::class, 'tools']) 
        ->name('tools');

        Route::get('/tools/add_tools', [VehicleController::class, 'add_tools']) 
        ->name('tools.add_tools');

        Route::post('/tools/edit_tools', [VehicleController::class, 'edit_tools']) 
        ->name('tools.edit_tools');

        //

        
        //  spare parts in storage - spare parts - inventory
        Route::get('/tools/tools_in_storage', [VehicleController::class, 'tools_in_storage']) 
        ->name('tools.tools_in_storage');

        Route::get('/tools/add_tools_in_storage', [VehicleController::class, 'add_tools_in_storage']) 
        ->name('tools.add_tools_in_storage');

        Route::post('/tools/view_tools_in_storage', [VehicleController::class, 'view_tools_in_storage']) 
        ->name('tools.view_tools_in_storage');

        Route::post('/tools/save_tools_in_storage', [VehicleController::class, 'save_tools_in_storage']) 
        ->name('tools.save_tools_in_storage');

        Route::post('/tools/edit_tools_in_storage', [VehicleController::class, 'edit_tools_in_storage']) 
        ->name('tools.edit_tools_in_storage');

        Route::post('/tools/update_tools_in_storage', [VehicleController::class, 'update_tools_in_storage']) 
        ->name('tools.update_tools_in_storage');

        Route::get('/tools/history', [VehicleController::class, 'tools_history']) 
        ->name('tools.tools_history');
        
        Route::post('/tools/table-history/clear', [VehicleController::class, 'tools_table_history_clear']) 
        ->name('tools.table_history_clear');

        Route::get('/tools/trash', [VehicleController::class, 'tools_trash']) 
        ->name('tools.tools_trash');

        Route::post('/tools/delete-tools-status', [VehicleController::class, 'delete_tools_status']) 
        ->name('tools.delete_tools_status');

        Route::post('tools/restore-tools', [VehicleController::class, 'restore_tools']) 
        ->name('tools.restore_tools');

        //  spare parts entry - spare parts - inventory
        Route::get('/tools/tools_entry', [VehicleController::class, 'tools_entry']) 
        ->name('tools.tools_entry');

        Route::get('/tools/add_tools_entry', [VehicleController::class, 'add_tools_entry']) 
        ->name('tools.add_tools_entry');

        Route::post('/tools/edit_tools_entry', [VehicleController::class, 'edit_tools_entry']) 
        ->name('tools.edit_tools_entry');

        Route::post('/tools/save_tools_entry', [VehicleController::class, 'save_tools_entry']) 
        ->name('tools.save_tools_entry');

        Route::post('/tools/update_tools_entry', [VehicleController::class, 'update_tools_entry']) 
        ->name('tools.update_tools_entry');

        Route::get('/tools/entery/history', [VehicleController::class, 'tools_entry_history']) 
        ->name('tools.tools_entry_history');
        
        // Route::post('/tools/entery/table-history/clear', [VehicleController::class, 'tools_table_history_clear']) 
        // ->name('tools.table_history_clear');

        Route::get('/tools/entery/trash', [VehicleController::class, 'tools_entry_trash']) 
        ->name('tools.tools_entry_trash');

        Route::post('/tools/entery/delete-tools-status', [VehicleController::class, 'delete_tools_entry_status']) 
        ->name('tools.delete_tools_entry_status');

        Route::post('tools/entery/restore-tools', [VehicleController::class, 'restore_tools_entry']) 
        ->name('tools.restore_tools_entry');

        //uncategorized
        Route::get('/uncategorized', [VehicleController::class, 'uncategorized']) 
        ->name('uncategorized');

        Route::get('/uncategorized/uncategorized_history', [VehicleController::class, 'uncategorized_history']) 
        ->name('uncategorized.uncategorized_history');

        Route::post('/uncategorized/view', [VehicleController::class, 'view_uncategorized']) 
        ->name('uncategorized.view_uncategorized');


        Route::get('/uncategorized/trash', [VehicleController::class, 'uncategorized_trash']) 
        ->name('uncategorized.uncategorized_trash');

        Route::post('/uncategorized/delete-tools-status', [VehicleController::class, 'delete_uncategorized_status']) 
        ->name('uncategorized.delete_uncategorized_status');

        Route::post('uncategorized/restore-tools', [VehicleController::class, 'restore_uncategorized_entry']) 
        ->name('uncategorized.restore_uncategorized_entry');
    

    });

?>