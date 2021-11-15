<?php 

use App\Http\Controllers\Admin\InventoryController;
use Illuminate\Support\Facades\Route;


    Route::group(['prefix'=>'/admin/inventory','as'=>'admin.inventory.'], function(){
        Route::get('/', [InventoryController::class, 'inventory']) 
        ->name('as');

        /////////////////////////////////
        /////////// Inventory ///////////
        /////////////////////////////////
        Route::get('/', [InventoryController::class, 'inventory']) 
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

        Route::post('/inventory/civil-defense/save', [InventoryController::class, 'save_inventory']) 
        ->name('save_inventory');

        Route::post('/inventory/civil-defense/update', [InventoryController::class, 'update_inventory']) 
        ->name('update_inventory');

        Route::post('/inventory/civil-defense/delete', [InventoryController::class, 'delete_inventory']) 
        ->name('delete_inventory');

        Route::get('/inventory/civil-defense/trash', [InventoryController::class, 'trash_inventory']) 
        ->name('trash_inventory');

        Route::post('/inventory/civil-defense/restor-delete', [InventoryController::class, 'restore_inventory']) 
        ->name('restore_inventory');

        Route::post('/inventory/civil-defense/delete-status', [InventoryController::class, 'delete_inventory_status']) 
        ->name('delete_inventory_status');

        //  mobile MUNCIPALITY

        Route::get('/inventory/muncipality', [InventoryController::class, 'mobile_muncipality']) 
        ->name('mobile_muncipality');

        Route::get('/inventory/muncipality/history', [InventoryController::class, 'mobile_muncipality_history']) 
        ->name('mobile_muncipality_history');

        Route::post('/inventory/muncipality/history/clear', [InventoryController::class, 'mobile_muncipality_history_clear']) 
        ->name('mobile_muncipality_history_clear');



        Route::get('/inventory/muncipality/add', [InventoryController::class, 'add_mobile_muncipality']) 
        ->name('add_mobile_muncipality');

        Route::post('/inventory/muncipality/save', [InventoryController::class, 'save_mobile_muncipality']) 
        ->name('save_mobile_muncipality');

        Route::post('/inventory/muncipality/update', [InventoryController::class, 'update_mobile_muncipality']) 
        ->name('update_mobile_muncipality');

        Route::post('/inventory/muncipality/edit', [InventoryController::class, 'edit_mobile_muncipality']) 
        ->name('edit_mobile_muncipality');

        Route::post('/inventory/muncipality/delete', [InventoryController::class, 'delete_mobile_muncipality']) 
        ->name('delete_mobile_muncipality');

        Route::get('/inventory/muncipality/trash', [InventoryController::class, 'trash_mobile_muncipality']) 
        ->name('trash_mobile_muncipality');

        Route::post('/inventory/muncipality/restor-delete', [InventoryController::class, 'restore_mobile_muncipality']) 
        ->name('restore_mobile_muncipality');

        Route::post('/inventory/muncipality/delete-status', [InventoryController::class, 'delete_mobile_muncipality_status']) 
        ->name('delete_mobile_muncipality_status');

        // mobile trained individules 

        Route::get('/inventory/trained-individual', [InventoryController::class, 'mobiles_trained_individual']) 
        ->name('mobile_trained_individual');

        Route::get('/inventory/trained-individuals', [InventoryController::class, 'mobiles_trained_individual']) 
        ->name('mobiles_trained_individual');

        Route::get('/inventory/trained-individual/history', [InventoryController::class, 'mobiles_trained_individual_history']) 
        ->name('mobile_trained_individual_history');

        Route::post('/inventory/trained-individual/history/clear', [InventoryController::class, 'mobiles_trained_individual_history_clear']) 
        ->name('mobile_trained_individual_clear');

        Route::get('/inventory/trained-individual/add', [InventoryController::class, 'add_mobiles_trained_individual']) 
        ->name('add_mobiles_trained_individual');

        Route::post('/mobile-fuel-tanks-renewals/trained-individual/save', [InventoryController::class, 'save_mobiles_trained_individual']) 
        ->name('save_mobiles_trained_individual');

        Route::post('/inventory/trained-individual/edit', [InventoryController::class, 'edit_mobiles_trained_individual'])
        ->name('edit_mobiles_trained_individual');

        Route::post('/inventory/trained-individual/update', [InventoryController::class, 'update_mobiles_trained_individual']) 
        ->name('update_mobiles_trained_individual');

        Route::post('/inventory/trained-individual/delete', [InventoryController::class, 'delete_mobiles_trained_individual']) 
        ->name('delete_mobiles_trained_individual');

        

        Route::get('/inventory/trained-individual/trash', [InventoryController::class, 'trash_mobiles_trained_individual']) 
        ->name('trash_mobiles_trained_individual');

        Route::post('/inventory/trained-individual/restor-delete', [InventoryController::class, 'restore_mobiles_trained_individual']) 
        ->name('restore_mobiles_trained_individual');

        Route::post('/inventory/trained-individual/delete-status', [InventoryController::class, 'delete_mobiles_trained_individual_status']) 
        ->name('delete_mobiles_trained_individual_status');

        Route::post('/inventory/trained-individual/view', [InventoryController::class, 'view_mobiles_trained_individual']) ->name('view_mobiles_trained_individual');

        //
    

    });

?>