<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InventoryController as Admin_InventoryController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\InventoryController;



use Illuminate\Support\Facades\Route;

    Route::get('/employee/inventory', [InventoryController::class, 'inventory']) 
    ->name('user.inventory');
    
    Route::group(['prefix'=>'/employee/inventory','as'=>'user.inventory.'], function(){

        /////////////////////////////////
        ///////// inventory /////////
        /////////////////////////////////
        Route::get('/inventory', [InventoryController::class, 'inventory']) 
        ->name('inventory');
        
        //  fuel - inventory
        Route::get('/fuel', [InventoryController::class, 'fuel']) 
        ->name('fuel');

        // purchased fuel - fuel - inventory
        Route::get('/fuel/purchased_fuel', [InventoryController::class, 'purchased_fuel']) 
        ->name('fuel.purchased_fuel');

        // readings - fuel - inventory
        Route::get('/fuel/readings', [InventoryController::class, 'readings']) 
        ->name('fuel.readings');

        Route::get('/fuel/readings/add_fuel_reading', [InventoryController::class, 'add_fuel_reading']) 
        ->name('fuel.readings.add_fuel_reading');

        Route::post('/fuel/readings/edit_fuel_reading', [InventoryController::class, 'edit_fuel_reading']) 
        ->name('fuel.readings.edit_fuel_reading');

        Route::get('/inventory/civil-defense/history', [InventoryController::class, 'inventory_history']) 
        ->name('inventory_history');

        Route::post('/inventory/civil-defense/history/clear', [InventoryController::class, 'inventory_history_clean']) 
        ->name('inventory_history_clean');

        Route::get('/inventory/civil-defense/trash', [InventoryController::class, 'trash_inventory']) 
        ->name('trash_inventory');

        Route::post('/inventory/civil-defense/restor-delete', [InventoryController::class, 'restore_inventory']) 
        ->name('restore_inventory');

        Route::post('/inventory/civil-defense/delete-status', [InventoryController::class, 'delete_inventory_status']) 
        ->name('delete_inventory_status');

        //  tyres - inventory

        Route::get('/tyres', [InventoryController::class, 'tyres']) 
        ->name('tyres');

        //  new/used tyres - tyres - inventory
        Route::get('/tyres/new_used_tyres', [InventoryController::class, 'new_used_tyres']) 
        ->name('tyres.new_used_tyres');

        Route::get('/tyres/add_used_tyres', [InventoryController::class, 'add_used_tyres']) 
        ->name('tyres.add_used_tyres');

        Route::post('/tyres/edit_used_tyres', [InventoryController::class, 'edit_used_tyres']) 
        ->name('tyres.edit_used_tyres');

        //  complain tyres - tyres - inventory
        Route::get('/tyres/complain_tyres', [InventoryController::class, 'complain_tyres']) 
        ->name('tyres.complain_tyres');

        Route::get('/tyres/add_complain_tyres', [InventoryController::class, 'add_complain_tyres']) 
        ->name('tyres.add_complain_tyres');

        Route::post('/tyres/edit_complain_tyres', [InventoryController::class, 'edit_complain_tyres']) 
        ->name('tyres.edit_complain_tyres');

        //  tyres entry - tyres - inventory
        Route::get('/tyres/tyres_entry', [InventoryController::class, 'tyres_entry']) 
        ->name('tyres.tyres_entry');

        Route::get('/tyres/add_tyres_entry', [InventoryController::class, 'add_tyres_entry']) 
        ->name('tyres.add_tyres_entry');

        Route::post('/tyres/edit_tyres_entry', [InventoryController::class, 'edit_tyres_entry']) 
        ->name('tyres.edit_tyres_entry');

        //  spare parts - inventory

        Route::get('/spare_parts', [InventoryController::class, 'spare_parts']) 
        ->name('spare_parts');

        //  spare parts in storage - spare parts - inventory
        Route::get('/spare_parts/spare_parts_in_storage', [InventoryController::class, 'spare_parts_in_storage']) 
        ->name('spare_parts.spare_parts_in_storage');

        Route::get('/spare_parts/add_spare_parts_in_storage', [InventoryController::class, 'add_spare_parts_in_storage']) 
        ->name('spare_parts.add_spare_parts_in_storage');

        Route::post('/spare_parts/edit_spare_parts_in_storage', [InventoryController::class, 'edit_spare_parts_in_storage']) 
        ->name('spare_parts.edit_spare_parts_in_storage');

        //  spare parts entry - spare parts - inventory
        Route::get('/spare_parts/spare_parts_entry', [InventoryController::class, 'spare_parts_entry']) 
        ->name('spare_parts.spare_parts_entry');

        Route::get('/spare_parts/add_spare_parts_entry', [InventoryController::class, 'add_spare_parts_entry']) 
        ->name('spare_parts.add_spare_parts_entry');

        Route::post('/spare_parts/edit_spare_parts_entry', [InventoryController::class, 'edit_spare_parts_entry']) 
        ->name('spare_parts.edit_spare_parts_entry');

        //  spare parts - inventory

        Route::get('/tools', [InventoryController::class, 'tools']) 
        ->name('tools');

        Route::get('/tools/add_tools', [InventoryController::class, 'add_tools']) 
        ->name('tools.add_tools');

        Route::post('/tools/edit_tools', [InventoryController::class, 'edit_tools']) 
        ->name('tools.edit_tools');
    

    });

?>