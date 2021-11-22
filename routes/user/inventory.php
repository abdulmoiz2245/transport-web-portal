<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InventoryController as Admin_InventoryController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\InventoryController;



use Illuminate\Support\Facades\Route;

    Route::get('/employee/inventory', [InventoryController::class, 'inventory']) 
    ->name('user.inventory');
    

    Route::group(['prefix'=>'/employee/inventory','as'=>'user.inventory.'], function(){
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

        Route::post('/fuel/readings/save_fuel_reading', [InventoryController::class, 'save_fuel_reading']) 
        ->name('fuel.readings.save_fuel_reading');

        Route::post('/fuel/readings/update_fuel_reading', [InventoryController::class, 'update_fuel_reading']) 
        ->name('fuel.readings.update_fuel_reading');

        Route::get('/fuel/readings/validate_reading_date/{date?}', [InventoryController::class, 'validate_reading_date']) 
        ->name('fuel.readings.validate_reading_date');

        Route::post('/fuel/readings/edit_fuel_reading', [InventoryController::class, 'edit_fuel_reading']) 
        ->name('fuel.readings.edit_fuel_reading');

        Route::get('/fuel/readings/trash_fuel_reading', [InventoryController::class, 'trash_fuel_reading']) 
        ->name('fuel.trash_fuel_reading');
        
        Route::get('/fuel/readings/history', [InventoryController::class, 'fuel_reading_history']) 
        ->name('fuel.fuel_reading_history');

        Route::post('/fuel/readings/restor-delete', [InventoryController::class, 'restore_fuel_reading']) 
        ->name('fuel.restore_fuel_reading');

        Route::post('/fuel/readings/delete-status', [InventoryController::class, 'delete_fuel_reading_status']) 
        ->name('fuel.delete_fuel_reading_status');

        //  tyres - inventory

        Route::get('/tyres', [InventoryController::class, 'tyres']) 
        ->name('tyres');

        //  new/used tyres - tyres - inventory
        Route::get('/tyres/new_used_tyres', [InventoryController::class, 'new_used_tyres']) 
        ->name('tyres.new_used_tyres');

        Route::get('/tyres/add_used_tyres', [InventoryController::class, 'add_used_tyres']) 
        ->name('tyres.add_used_tyres');

        Route::post('/tyres/save_used_tyres', [InventoryController::class, 'save_used_tyres']) 
        ->name('tyres.save_new_used_tyres');

        Route::post('/tyres/edit_used_tyres', [InventoryController::class, 'edit_used_tyres']) 
        ->name('tyres.edit_used_tyres');

        Route::post('/tyres/update_used_tyres', [InventoryController::class, 'update_used_tyres']) 
        ->name('tyres.update_new_used_tyres');

        Route::get('/tyres/history', [InventoryController::class, 'tyres_history']) 
        ->name('tyres.tyres_history');
        
        Route::post('/tyres/table-history/clear', [InventoryController::class, 'table_history_clear']) 
        ->name('tyres.table_history_clear');

        Route::post('/tyres/delete-used-tyres-status', [InventoryController::class, 'delete_used_tyres_status']) 
        ->name('tyres.delete_used_tyres_status');

        Route::post('tyres/restore-used-tyres', [InventoryController::class, 'restore_used_tyres']) 
        ->name('restore_used_tyres');

        
        
        Route::get('/tyres/trash_used_tyres', [InventoryController::class, 'trash_used_tyres']) 
        ->name('tyres.trash_used_tyres');

        //  complain tyres - tyres - inventory
        Route::get('/tyres/complain_tyres', [InventoryController::class, 'complain_tyres']) 
        ->name('tyres.complain_tyres');

        Route::get('/tyres/add_complain_tyres', [InventoryController::class, 'add_complain_tyres']) 
        ->name('tyres.add_complain_tyres');

        Route::post('/tyres/save_complain_tyres', [InventoryController::class, 'save_complain_tyres']) 
        ->name('tyres.save_complain_tyres');

        Route::post('/tyres/edit_complain_tyres', [InventoryController::class, 'edit_complain_tyres']) 
        ->name('tyres.edit_complain_tyres');

        Route::post('/tyres/update_complain_tyres', [InventoryController::class, 'update_complain_tyres']) 
        ->name('tyres.update_complain_tyres');

        

        //  tyres entry - tyres - inventory
        Route::get('/tyres/tyres_entry', [InventoryController::class, 'tyres_entry']) 
        ->name('tyres.tyres_entry');

        Route::get('/tyres/add_tyres_entry', [InventoryController::class, 'add_tyres_entry']) 
        ->name('tyres.add_tyres_entry');

        Route::post('/tyres/save_tyres_entry', [InventoryController::class, 'save_tyres_entry']) 
        ->name('tyres.save_tyres_entry');

        Route::post('/tyres/edit_tyres_entry', [InventoryController::class, 'edit_tyres_entry']) 
        ->name('tyres.edit_tyres_entry');

        
        Route::post('/tyres/update_tyres_entry', [InventoryController::class, 'update_tyres_entry']) 
        ->name('tyres.update_tyres_entry');


        //  spare parts - inventory

        Route::get('/spare_parts', [InventoryController::class, 'spare_parts']) 
        ->name('spare_parts');

        //  spare parts in storage - spare parts - inventory
        Route::get('/spare-parts/spare_parts_in_storage', [InventoryController::class, 'spare_parts_in_storage']) 
        ->name('spare_parts.spare_parts_in_storage');

        Route::get('/spare-parts/add_spare_parts_in_storage', [InventoryController::class, 'add_spare_parts_in_storage']) 
        ->name('spare_parts.add_spare_parts_in_storage');

        Route::post('/spare-parts/save_spare_parts_in_storage', [InventoryController::class, 'save_spare_parts_in_storage']) 
        ->name('spare_parts.save_spare_parts_in_storage');

        Route::post('/spare-parts/edit_spare_parts_in_storage', [InventoryController::class, 'edit_spare_parts_in_storage']) 
        ->name('spare_parts.edit_spare_parts_in_storage');

        Route::post('/spare-parts/update_spare_parts_in_storage', [InventoryController::class, 'update_spare_parts_in_storage']) 
        ->name('spare_parts.update_spare_parts_in_storage');

        Route::get('/spare-parts/history', [InventoryController::class, 'spare_parts_history']) 
        ->name('spare_parts.spare_parts_history');
        
        Route::post('/spare-parts/table-history/clear', [InventoryController::class, 'spare_parts_table_history_clear']) 
        ->name('spare_parts.table_history_clear');

        Route::get('/spare-parts/trash', [InventoryController::class, 'spare_parts_trash']) 
        ->name('spare_parts.spare_parts_trash');

        Route::post('/spare-parts/delete-spare-parts-status', [InventoryController::class, 'delete_spare_parts_status']) 
        ->name('spare_parts.delete_spare_parts_status');

        Route::post('spare-parts/restore-spare-parts', [InventoryController::class, 'restore_spare_parts']) 
        ->name('spare_parts.restore_spare_parts');

        //  spare parts entry - spare parts - inventory
        Route::get('/spare_parts/spare_parts_entry', [InventoryController::class, 'spare_parts_entry']) 
        ->name('spare_parts.spare_parts_entry');

        Route::get('/spare_parts/add_spare_parts_entry', [InventoryController::class, 'add_spare_parts_entry']) 
        ->name('spare_parts.add_spare_parts_entry');

        Route::post('/spare_parts/edit_spare_parts_entry', [InventoryController::class, 'edit_spare_parts_entry']) 
        ->name('spare_parts.edit_spare_parts_entry');

        Route::post('/spare_parts/save_spare_parts_entry', [InventoryController::class, 'save_spare_parts_entry']) 
        ->name('spare_parts.save_spare_parts_entry');

        Route::post('/spare_parts/update_spare_parts_entry', [InventoryController::class, 'update_spare_parts_entry']) 
        ->name('spare_parts.update_spare_parts_entry');

        Route::get('/spare-parts/entery/history', [InventoryController::class, 'spare_parts_entry_history']) 
        ->name('spare_parts.spare_parts_entry_history');
        
        // Route::post('/spare-parts/entery/table-history/clear', [InventoryController::class, 'spare_parts_table_history_clear']) 
        // ->name('spare_parts.table_history_clear');

        Route::get('/spare-parts/entery/trash', [InventoryController::class, 'spare_parts_entry_trash']) 
        ->name('spare_parts.spare_parts_entry_trash');

        Route::post('/spare-parts/entery/delete-spare-parts-status', [InventoryController::class, 'delete_spare_parts_entry_status']) 
        ->name('spare_parts.delete_spare_parts_entry_status');

        Route::post('spare-parts/entery/restore-spare-parts', [InventoryController::class, 'restore_spare_parts_entry']) 
        ->name('spare_parts.restore_spare_parts_entry');

        //  tools - inventory

        Route::get('/tools', [InventoryController::class, 'tools']) 
        ->name('tools');

        Route::get('/tools/add_tools', [InventoryController::class, 'add_tools']) 
        ->name('tools.add_tools');

        Route::post('/tools/edit_tools', [InventoryController::class, 'edit_tools']) 
        ->name('tools.edit_tools');

        //

        
        //  spare parts in storage - spare parts - inventory
        Route::get('/tools/tools_in_storage', [InventoryController::class, 'tools_in_storage']) 
        ->name('tools.tools_in_storage');

        Route::get('/tools/add_tools_in_storage', [InventoryController::class, 'add_tools_in_storage']) 
        ->name('tools.add_tools_in_storage');

        Route::post('/tools/view_tools_in_storage', [InventoryController::class, 'view_tools_in_storage']) 
        ->name('tools.view_tools_in_storage');

        Route::post('/tools/save_tools_in_storage', [InventoryController::class, 'save_tools_in_storage']) 
        ->name('tools.save_tools_in_storage');

        Route::post('/tools/edit_tools_in_storage', [InventoryController::class, 'edit_tools_in_storage']) 
        ->name('tools.edit_tools_in_storage');

        Route::post('/tools/update_tools_in_storage', [InventoryController::class, 'update_tools_in_storage']) 
        ->name('tools.update_tools_in_storage');

        Route::get('/tools/history', [InventoryController::class, 'tools_history']) 
        ->name('tools.tools_history');
        
        Route::post('/tools/table-history/clear', [InventoryController::class, 'tools_table_history_clear']) 
        ->name('tools.table_history_clear');

        Route::get('/tools/trash', [InventoryController::class, 'tools_trash']) 
        ->name('tools.tools_trash');

        Route::post('/tools/delete-tools-status', [InventoryController::class, 'delete_tools_status']) 
        ->name('tools.delete_tools_status');

        Route::post('tools/restore-tools', [InventoryController::class, 'restore_tools']) 
        ->name('tools.restore_tools');

        //  spare parts entry - spare parts - inventory
        Route::get('/tools/tools_entry', [InventoryController::class, 'tools_entry']) 
        ->name('tools.tools_entry');

        Route::get('/tools/add_tools_entry', [InventoryController::class, 'add_tools_entry']) 
        ->name('tools.add_tools_entry');

        Route::post('/tools/edit_tools_entry', [InventoryController::class, 'edit_tools_entry']) 
        ->name('tools.edit_tools_entry');

        Route::post('/tools/save_tools_entry', [InventoryController::class, 'save_tools_entry']) 
        ->name('tools.save_tools_entry');

        Route::post('/tools/update_tools_entry', [InventoryController::class, 'update_tools_entry']) 
        ->name('tools.update_tools_entry');

        Route::get('/tools/entery/history', [InventoryController::class, 'tools_entry_history']) 
        ->name('tools.tools_entry_history');
        
        // Route::post('/tools/entery/table-history/clear', [InventoryController::class, 'tools_table_history_clear']) 
        // ->name('tools.table_history_clear');

        Route::get('/tools/entery/trash', [InventoryController::class, 'tools_entry_trash']) 
        ->name('tools.tools_entry_trash');

        Route::post('/tools/entery/delete-tools-status', [InventoryController::class, 'delete_tools_entry_status']) 
        ->name('tools.delete_tools_entry_status');

        Route::post('tools/entery/restore-tools', [InventoryController::class, 'restore_tools_entry']) 
        ->name('tools.restore_tools_entry');
        //

        Route::get('/uncategorized', [InventoryController::class, 'uncategorized']) 
        ->name('uncategorized');

        Route::get('/uncategorized/uncategorized_history', [InventoryController::class, 'uncategorized_history']) 
        ->name('uncategorized.uncategorized_history');

        Route::post('/uncategorized/view', [InventoryController::class, 'view_uncategorized']) 
        ->name('uncategorized.view_uncategorized');

        Route::get('/uncategorized/trash', [InventoryController::class, 'uncategorized_trash']) 
        ->name('uncategorized.uncategorized_trash');

        Route::post('/uncategorized/delete-tools-status', [InventoryController::class, 'delete_uncategorized_status']) 
        ->name('uncategorized.delete_uncategorized_status');

        Route::post('uncategorized/restore-tools', [InventoryController::class, 'restore_uncategorized_entry']) 
        ->name('uncategorized.restore_uncategorized_entry');

    });

?>