<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;

    Route::get('/employee/hr-pro', [Hr_ProController::class, 'hr_pro']) 
    ->name('user.hr_pro');
    
    Route::group(['prefix'=>'/employee/hr-pro','as'=>'user.hr_pro.'], function(){
        // Route::get('/', [UserController::class, 'hr_pro']) 
        // ->name('user.hr_pro');

        Route::get('/employee', [Hr_ProController::class, 'hr_pro']) 
        ->name('employee');

        Route::get('/employee-salaries', [Hr_ProController::class, 'hr_pro']) 
        ->name('employee_salaries');

        Route::get('/complaints', [Hr_ProController::class, 'hr_pro']) 
        ->name('complaints');

        /////////////////////////////////
        ///////// Trade License /////////
        /////////////////////////////////
        Route::get('/trade-license-sponsors-partners', [Hr_ProController::class, 'trade_license']) 
        ->name('trade_license__sponsors__partners');
        

        Route::post('/trade-license-sponsors-partners/view', [Hr_ProController::class, 'view_trade_license']) 
        ->name('view_trade_license__sponsors__partners');

        Route::get('/trade-license-sponsors-partners/history', [Hr_ProController::class, 'trade_license_history']) 
        ->name('trade_license__sponsors__partners_history');

        Route::post('/trade-license-sponsors-partners/history/clear', [Hr_ProController::class, 'trade_license_history_clear']) 
        ->name('trade_license__sponsors__partners_history_clear');

        Route::get('/trade-license-sponsors-partners/add', [Hr_ProController::class, 'add_trade_license']) 
        ->name('add_trade_license__sponsors__partners');

        Route::post('/trade-license-sponsors-partners/edit', [Hr_ProController::class, 'edit_trade_license']) 
        ->name('edit_trade_license__sponsors__partners');

        Route::post('/trade-license-sponsors-partners/update', [Hr_ProController::class, 'update_trade_license']) 
        ->name('update_trade_license__sponsors__partners');

        Route::post('/trade-license-sponsors-partners/delete', [Hr_ProController::class, 'delete_trade_license']) 
        ->name('delete_trade_license__sponsors__partners');

        Route::post('/trade-license-sponsors-partners/save', [Hr_ProController::class, 'save_trade_license']) 
        ->name('save_trade_license__sponsors__partners');

        //company 
        Route::get('/trade-license-sponsors-partners/add-company', [Hr_ProController::class, 'add_comany_name']) 
        ->name('add_comany_name');

        Route::post('/trade-license-sponsors-partners/save-company', [Hr_ProController::class, 'save_company']) 
        ->name('save_company');

        ///////////////////////////////////////////////////
        ///////// office contract land contact ////////////
        ///////////////////////////////////////////////////

        Route::get('/office-contracts-land-contracts', [Hr_ProController::class, 'office_contract_land_contract']) 
        ->name('office_contracts__land_contracts');

        //office

        Route::get('/office-contracts-land-contracts/office-contract', [Hr_ProController::class, 'office_contract']) 
        ->name('office_contracts');

        Route::get('/office-contracts-land-contracts/office-contract/history', [Hr_ProController::class, 'office_contracts_history']) 
        ->name('office_contracts_history');

        Route::post('/office-contracts-land-contracts/office-contract/history/clear', [Hr_ProController::class, 'office_contracts_history_clear']) 
        ->name('office_contracts_history_clear');

        Route::get('/office-contracts-land-contracts/office/add', [Hr_ProController::class, 'add_office_contract']) 
        ->name('add_office_contracts');

        Route::post('/office-contracts-land-contracts/office-contract/save', [Hr_ProController::class, 'save_office_contract']) 
        ->name('save_office_contracts');

        Route::post('/office-contracts-land-contracts/office-contract/edit', [Hr_ProController::class, 'edit_office_contract']) 
        ->name('edit_office_contracts');

        Route::post('/office-contracts-land-contracts/office-contract/update', [Hr_ProController::class, 'update_office_contract']) 
        ->name('update_office_contracts');

        Route::post('/office-contracts-land-contracts/office-contract/delete', [Hr_ProController::class, 'delete_office_contract']) 
        ->name('delete_office_contracts');

        Route::post('/office-contracts-land-contracts/office-contract/view', [Hr_ProController::class, 'view_office_contract']) 
        ->name('view_office_contracts');

        //land
        Route::get('/office-contracts-land-contracts/land', [Hr_ProController::class, 'land_contract']) 
        ->name('land_contracts');

        Route::get('/office-contracts-land-contracts/land/history', [Hr_ProController::class, 'land_contracts_history']) 
        ->name('land_contracts_history');

        Route::post('/office-contracts-land-contracts/land/history/clear', [Hr_ProController::class, 'land_contracts_history_clear']) 
        ->name('land_contracts_history_clear');

        Route::get('/office-contracts-land-contracts/land/add', [Hr_ProController::class, 'add_land_contract']) 
        ->name('add_land_contracts');

        Route::post('/office-contracts-land-contracts/land-contract/save', [Hr_ProController::class, 'save_land_contract']) 
        ->name('save_land_contracts');

        Route::post('/office-contracts-land-contracts/land-contract/edit', [Hr_ProController::class, 'edit_land_contract'])
        ->name('edit_land_contracts');

        Route::post('/office-contracts-land-contracts/land-contract/update', [Hr_ProController::class, 'update_land_contract']) 
        ->name('update_land_contracts');

        Route::post('/office-contracts-land-contracts/land-contract/delete', [Hr_ProController::class, 'delete_land_contract']) 
        ->name('delete_land_contracts');

        Route::post('/office-contracts-land-contracts/land-contract/view', [Hr_ProController::class, 'view_land_contract']) 
        ->name('view_land_contracts');

        ///////////////////////////////////////////////////
        ///////// non_mobiles_fuel_tanks_renewals /////////
        ///////////////////////////////////////////////////
        Route::get('/non-mobiles-fuel-tanks-renewals', [Hr_ProController::class, 'non_mobiles_fuel_tanks_renewals']) 
        ->name('non_mobiles_fuel_tanks_renewals');

        Route::get('/non-mobiles-fuel-tanks-renewals/civil-defense/history', [Hr_ProController::class, 'non_mobile_civil_defence_history']) 
        ->name('non_mobile_civil_defence_history');

        Route::post('/non-mobiles-fuel-tanks-renewals/civil-defense/history/clear', [Hr_ProController::class, 'non_mobile_civil_defence_history_clear']) 
        ->name('non_mobile_civil_defence_history_clear');

        // non mobile civil defence
        Route::get('/non-mobiles-fuel-tanks-renewals/civil-defense', [Hr_ProController::class, 'non_mobile_civil_defence']) 
        ->name('non_mobile_civil_defence');

        Route::get('/non-mobiles-fuel-tanks-renewals/civil-defense/add', [Hr_ProController::class, 'add_non_mobile_civil_defence']) 
        ->name('add_non_mobile_civil_defence');

        Route::post('/non-mobiles-fuel-tanks-renewals/civil-defense/save', [Hr_ProController::class, 'save_non_mobile_civil_defence']) 
        ->name('save_non_mobile_civil_defence');

        Route::post('/non-mobiles-fuel-tanks-renewals/civil-defense/update', [Hr_ProController::class, 'update_non_mobile_civil_defence']) 
        ->name('update_non_mobile_civil_defence');

        Route::post('/non-mobiles-fuel-tanks-renewals/civil-defense/edit', [Hr_ProController::class, 'edit_non_mobile_civil_defence']) 
        ->name('edit_non_mobile_civil_defence');

        Route::post('/non-mobiles-fuel-tanks-renewals/civil-defense/delete', [Hr_ProController::class, 'delete_non_mobile_civil_defence']) 
        ->name('delete_non_mobile_civil_defence');

        // non mobile MUNCIPALITY

        Route::get('/non-mobiles-fuel-tanks-renewals/muncipality', [Hr_ProController::class, 'non_mobile_muncipality']) 
        ->name('non_mobile_muncipality');

        Route::get('/non-mobiles-fuel-tanks-renewals/muncipality/history', [Hr_ProController::class, 'non_mobile_muncipality_history']) 
        ->name('non_mobile_muncipality_history');

        Route::post('/non-mobiles-fuel-tanks-renewals/muncipality/history/clear', [Hr_ProController::class, 'non_mobile_muncipality_history_clear']) 
        ->name('non_mobile_muncipality_history_clear');

        Route::get('/non-mobiles-fuel-tanks-renewals/muncipality/add', [Hr_ProController::class, 'add_non_mobile_muncipality']) 
        ->name('add_non_mobile_muncipality');

        Route::post('/non-mobiles-fuel-tanks-renewals/muncipality/save', [Hr_ProController::class, 'save_non_mobile_muncipality']) 
        ->name('save_non_mobile_muncipality');

        Route::post('/non-mobiles-fuel-tanks-renewals/muncipality/update', [Hr_ProController::class, 'update_non_mobile_muncipality']) 
        ->name('update_non_mobile_muncipality');

        Route::post('/non-mobiles-fuel-tanks-renewals/muncipality/edit', [Hr_ProController::class, 'edit_non_mobile_muncipality']) 
        ->name('edit_non_mobile_muncipality');

        Route::post('/non-mobiles-fuel-tanks-renewals/muncipality/delete', [Hr_ProController::class, 'delete_non_mobile_muncipality']) 
        ->name('delete_non_mobile_muncipality');

        //non mobile trained individules 

        Route::get('/non-mobiles-fuel-tanks-renewals/trained-individual', [Hr_ProController::class, 'non_mobile_trained_individual']) 
        ->name('non_mobile_trained_individual');

        Route::get('/non-mobiles-fuel-tanks-renewals/trained-individual/history', [Hr_ProController::class, 'non_mobile_trained_individual_history']) 
        ->name('non_mobile_trained_individual_history');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/history/clear', [Hr_ProController::class, 'non_mobile_trained_individual_history_clear']) 
        ->name('non_mobile_trained_individual_history_clear');

        Route::get('/non-mobiles-fuel-tanks-renewals/trained-individual/add', [Hr_ProController::class, 'add_non_mobile_trained_individual']) 
        ->name('add_non_mobile_trained_individual');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/save', [Hr_ProController::class, 'save_non_mobile_trained_individual']) 
        ->name('save_non_mobile_trained_individual');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/edit', [Hr_ProController::class, 'edit_non_mobile_trained_individual'])
        ->name('edit_non_mobile_trained_individual');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/update', [Hr_ProController::class, 'update_non_mobile_trained_individual']) 
        ->name('update_non_mobile_trained_individual');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/land-contract/delete', [Hr_ProController::class, 'delete_non_mobile_trained_individual']) 
        ->name('delete_non_mobile_trained_individual');

        Route::post('/non-mobiles-fuel-tanks-renewals/trained-individual/view', [Hr_ProController::class, 'view_non_mobile_trained_individual']) ->name('view_non_mobile_trained_individual');

        ///////////////////////////////////////////////////
        ///////// mobiles_fuel_tanks_renewals /////////////
        ///////////////////////////////////////////////////

        Route::get('/mobiles-fuel-tanks-renewals', [Hr_ProController::class, 'mobiles_fuel_tanks_renewals']) 
        ->name('mobiles_fuel_tanks_renewals');

        //  mobile civil defence
        Route::get('/mobiles-fuel-tanks-renewals/civil-defense', [Hr_ProController::class, 'mobile_civil_defence']) 
        ->name('mobile_civil_defence');

        Route::get('/mobiles-fuel-tanks-renewals/civil-defense/history', [Hr_ProController::class, 'mobile_civil_defence_history']) 
        ->name('mobile_civil_defence_history');

        Route::post('/mobiles-fuel-tanks-renewals/civil-defense/history/clear', [Hr_ProController::class, 'mobile_civil_defence_history_clean']) 
        ->name('mobile_civil_defence_history_clean');

        Route::get('/mobiles-fuel-tanks-renewals/civil-defense/add', [Hr_ProController::class, 'add_mobile_civil_defence']) 
        ->name('add_mobile_civil_defence');

        Route::post('/mobiles-fuel-tanks-renewals/civil-defense/save', [Hr_ProController::class, 'save_mobile_civil_defence']) 
        ->name('save_mobile_civil_defence');

        Route::post('/mobiles-fuel-tanks-renewals/civil-defense/update', [Hr_ProController::class, 'update_mobile_civil_defence']) 
        ->name('update_mobile_civil_defence');

        Route::post('/mobiles-fuel-tanks-renewals/civil-defense/edit', [Hr_ProController::class, 'edit_mobile_civil_defence']) 
        ->name('edit_mobile_civil_defence');

        Route::post('/mobiles-fuel-tanks-renewals/civil-defense/delete', [Hr_ProController::class, 'delete_mobile_civil_defence']) 
        ->name('delete_mobile_civil_defence');

        //  mobile MUNCIPALITY

        Route::get('/mobiles-fuel-tanks-renewals/muncipality', [Hr_ProController::class, 'mobile_muncipality']) 
        ->name('mobile_muncipality');

        Route::get('/mobiles-fuel-tanks-renewals/muncipality/history', [Hr_ProController::class, 'mobile_muncipality_history']) 
        ->name('mobile_muncipality_history');

        Route::post('/mobiles-fuel-tanks-renewals/muncipality/history/clear', [Hr_ProController::class, 'mobile_muncipality_history_clear']) 
        ->name('mobile_muncipality_history_clear');

        Route::get('/mobiles-fuel-tanks-renewals/muncipality/add', [Hr_ProController::class, 'add_mobile_muncipality']) 
        ->name('add_mobile_muncipality');

        Route::post('/mobiles-fuel-tanks-renewals/muncipality/save', [Hr_ProController::class, 'save_mobile_muncipality']) 
        ->name('save_mobile_muncipality');

        Route::post('/mobiles-fuel-tanks-renewals/muncipality/update', [Hr_ProController::class, 'update_mobile_muncipality']) 
        ->name('update_mobile_muncipality');

        Route::post('/mobiles-fuel-tanks-renewals/muncipality/edit', [Hr_ProController::class, 'edit_mobile_muncipality']) 
        ->name('edit_mobile_muncipality');

        Route::post('/mobiles-fuel-tanks-renewals/muncipality/delete', [Hr_ProController::class, 'delete_mobile_muncipality']) 
        ->name('delete_mobile_muncipality');

        // mobile trained individules 

        Route::get('/mobiles-fuel-tanks-renewals/trained-individual', [Hr_ProController::class, 'mobiles_trained_individual']) 
        ->name('mobiles_trained_individual');

        Route::get('/mobiles-fuel-tanks-renewals/trained-individual/history', [Hr_ProController::class, 'mobiles_trained_individual_history']) 
        ->name('mobiles_trained_individual_history');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/history/clear', [Hr_ProController::class, 'mobiles_trained_individual_history_clear']) 
        ->name('mobiles_trained_individual_clear');

        Route::get('/mobiles-fuel-tanks-renewals/trained-individual/add', [Hr_ProController::class, 'add_mobiles_trained_individual']) 
        ->name('add_mobiles_trained_individual');

        Route::post('/mobile-fuel-tanks-renewals/trained-individual/save', [Hr_ProController::class, 'save_mobiles_trained_individual']) 
        ->name('save_mobiles_trained_individual');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/edit', [Hr_ProController::class, 'edit_mobiles_trained_individual'])
        ->name('edit_mobiles_trained_individual');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/update', [Hr_ProController::class, 'update_mobiles_trained_individual']) 
        ->name('update_mobiles_trained_individual');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/land-contract/delete', [Hr_ProController::class, 'delete_mobiles_trained_individual']) 
        ->name('delete_mobiles_trained_individual');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/view', [Hr_ProController::class, 'view_mobiles_trained_individual']) ->name('view_mobiles_trained_individual');
        

        ///////////////////////////////////////////////////
        ///////// Login access /////////////
        ///////////////////////////////////////////////////
        Route::get('/login-access-passwords', [Hr_ProController::class, 'login_password']) 
        ->name('login_access_and_passwords');

        Route::post('/login-access-passwords/save', [Hr_ProController::class, 'save_login_password']) 
        ->name('save.login_access_and_passwords');

        Route::get('/request-for-funds', [Hr_ProController::class, 'hr_pro']) 
        ->name('request_for_funds');

        Route::get('/vehicle_fines', [Hr_ProController::class, 'hr_pro']) 
        ->name('vehicle_fines');

        ///////////////////////////////////////////////////
        ///////// Trained individules /////////////////////
        ///////////////////////////////////////////////////

        
    });
?>