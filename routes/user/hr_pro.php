<?php 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;
use App\Http\Controllers\User\EmployeeController;


use Illuminate\Support\Facades\Route;

    Route::get('/employee/hr-pro', [Hr_ProController::class, 'hr_pro']) 
    ->name('user.hr_pro');
    
    Route::group(['prefix'=>'/employee/hr-pro','as'=>'user.hr_pro.'], function(){
        // Route::get('/', [UserController::class, 'hr_pro']) 
        // ->name('user.hr_pro');

        
    /////////////////////////////////
    ///////// Employee //////////////
    /////////////////////////////////

    Route::get('/employee', [EmployeeController::class, 'employee']) 
    ->name('employee');

    Route::get('/employee/existing-detail', [EmployeeController::class, 'existing_employee_detail']) 
    ->name('existing_employee_detail');

    Route::get('/employee/history', [EmployeeController::class, 'employee_history']) 
    ->name('employee_history');
    Route::get('/employee/trash', [EmployeeController::class, 'trash_employee']) 
    ->name('trash_employee');

    Route::get('/employee', [EmployeeController::class, 'employee']) 
    ->name('employee');

    Route::get('/employee/add-new', [EmployeeController::class, 'add_employee']) 
    ->name('add_employee');

    Route::post('/employee/save', [EmployeeController::class, 'save_employee']) 
    ->name('save_employee');

    Route::post('/employee/edit', [EmployeeController::class, 'edit_employee']) 
    ->name('edit_employee');

    Route::post('/employee/update', [EmployeeController::class, 'update_employee']) 
    ->name('update_employee');

    Route::post('/employee/view', [EmployeeController::class, 'view_employee']) 
    ->name('view_employee');
    Route::post('/employee/delete-status', [EmployeeController::class, 'delete_employee_status']) 
    ->name('delete_employee_status');

    Route::post('/employee/doj', [EmployeeController::class, 'employee_doj']) 
    ->name('employee_doj');


    Route::post('/employee/update-status', [EmployeeController::class, 'update_employee_status']) 
    ->name('update_employee_status');

    //salary card 

    Route::post('/employee/add/salary-card', [EmployeeController::class, 'add_salary_card']) 
    ->name('add_salary_card');

    Route::get('/employee/pending', [EmployeeController::class, 'pending_employee']) 
    ->name('pending_employee');

    Route::get('/employee/pending-for-joining', [EmployeeController::class, 'pending_employee_for_joining']) 
    ->name('pending_employee_for_joining');

    Route::get('/employee/existing', [EmployeeController::class, 'existing_employee']) 
    ->name('existing_employee');

    Route::get('/employee/attendence', [EmployeeController::class, 'employee_attendence']) 
    ->name('employee_attendence');

    Route::get('/employee/attendence/mark/{date?}', [EmployeeController::class, 'employee_attendence_mark']) 
    ->name('employee_attendence_mark');

    Route::get('/employee/attendence/report/{date?}', [EmployeeController::class, 'employee_attendence_report']) 
    ->name('employee_attendence_report');

    Route::post('/employee/employee-attendance/save', [EmployeeController::class, 'save_employee_attendance']) 
    ->name('save_employee_attendance');

    Route::get('/employee/attendence/leave', [EmployeeController::class, 'employee_leave']) 
    ->name('employee_leave');


    

    Route::get('/employee/attendence/leave/history', [EmployeeController::class, 'employee_leave_history']) 
    ->name('employee_leave_history');

    Route::post('/employee/attendence/leave/history/clear', [EmployeeController::class, 'employee_leave_history_clear']) 
    ->name('employee_leave_history_clear');

    Route::get('/employee/attendence/leave/add', [EmployeeController::class, 'add_employee_leave']) 
    ->name('add_employee_leave');

    Route::post('/employee/attendence/leave/save', [EmployeeController::class, 'save_employee_leave']) 
    ->name('save_employee_leave');

    Route::post('/employee/attendence/leave/edit', [EmployeeController::class, 'edit_employee_leave']) 
    ->name('edit_employee_leave');

    Route::post('/employee/attendence/leave/update', [EmployeeController::class, 'update_employee_leave']) 
    ->name('update_employee_leave');

    Route::post('/employee/attendence/leave/delete', [EmployeeController::class, 'delete_employee_leave']) 
    ->name('delete_employee_leave');

    Route::get('/employee/attendence/leave/trash', [EmployeeController::class, 'trash_employee_leave']) 
    ->name('trash_employee_leave');

    Route::post('/employee/attendence/leave/restor-delete', [EmployeeController::class, 'restore_employee_leave']) 
    ->name('restore_employee_leave');

    Route::post('/employee/attendence/leave/delete-status', [EmployeeController::class, 'delete_employee_leave_status']) 
    ->name('delete_employee_leave_status');

    Route::post('/employee/attendence/leave/view', [EmployeeController::class, 'view_employee_leave']) 
    ->name('view_employee_leave');

    //attendance absent request
    Route::get('/employee/attendence/absent', [EmployeeController::class, 'employee_absent']) 
    ->name('employee_absent');
    //complaints
    Route::get('/employee/attendence/absent', [EmployeeController::class, 'absent']) 
    ->name('absent');

    
    

    Route::get('/employee/attendence/history', [EmployeeController::class, 'absent_history']) 
    ->name('absent_history');

    Route::post('/employee/attendence/history/clear', [EmployeeController::class, 'absent_history_clear']) 
    ->name('absent_history_clear');

    Route::get('/employee/attendence/add', [EmployeeController::class, 'add_absent']) 
    ->name('add_absent');

    Route::post('/employee/attendence/save', [EmployeeController::class, 'save_absent']) 
    ->name('save_absent');

    Route::post('/employee/attendence/edit', [EmployeeController::class, 'edit_absent']) 
    ->name('edit_absent');

    Route::post('/employee/attendence/update', [EmployeeController::class, 'update_absent']) 
    ->name('update_absent');

    Route::post('/employee/attendence/delete', [EmployeeController::class, 'delete_absent']) 
    ->name('delete_absent');

    Route::get('/employee/attendence/trash', [EmployeeController::class, 'trash_absent']) 
    ->name('trash_absent');

    Route::post('/employee/attendence/restor-delete', [EmployeeController::class, 'restore_absent']) 
    ->name('restore_absent');

    Route::post('/employee/attendence/delete-status', [EmployeeController::class, 'delete_absent_status']) 
    ->name('delete_absent_status');

    Route::post('/employee/attendence/view', [EmployeeController::class, 'view_absent']) 
    ->name('view_absent');

    //termination
    Route::get('/employee/terminate', [EmployeeController::class, 'employee_terminate']) 
    ->name('employee_terminate');

    

    Route::get('/employee/termination/history', [EmployeeController::class, 'employee_termination_history']) 
    ->name('employee_termination_history');

    Route::post('/employee/termination/history/clear', [EmployeeController::class, 'employee_termination_history_clear']) 
    ->name('employee_termination_history_clear');

    Route::get('/employee/termination/add', [EmployeeController::class, 'add_employee_termination']) 
    ->name('add_employee_termination');

    Route::post('/employee/termination/save', [EmployeeController::class, 'save_employee_termination']) 
    ->name('save_employee_termination');

    Route::post('/employee/termination/edit', [EmployeeController::class, 'edit_employee_termination']) 
    ->name('edit_employee_termination');

    Route::post('/employee/termination/update', [EmployeeController::class, 'update_employee_termination']) 
    ->name('update_employee_termination');

    Route::post('/employee/termination/delete', [EmployeeController::class, 'delete_employee_termination']) 
    ->name('delete_employee_termination');

    Route::get('/employee/termination/trash', [EmployeeController::class, 'trash_employee_termination']) 
    ->name('trash_employee_termination');

    Route::post('/employee/termination/restor-delete', [EmployeeController::class, 'restore_employee_termination']) 
    ->name('restore_employee_termination');

    Route::post('/employee/termination/delete-status', [EmployeeController::class, 'delete_employee_termination_status']) 
    ->name('delete_employee_termination_status');

    Route::post('/employee/termination/view', [EmployeeController::class, 'view_employee_termination']) 
    ->name('view_employee_termination');

    //suspension
    Route::get('/employee/suspension', [EmployeeController::class, 'employee_suspension']) 
    ->name('employee_suspension');

    Route::get('/employee/suspension/history', [EmployeeController::class, 'employee_suspension_history']) 
    ->name('employee_suspension_history');

    Route::post('/employee/suspension/history/clear', [EmployeeController::class, 'employee_suspension_history_clear']) 
    ->name('employee_suspension_history_clear');

    Route::get('/employee/suspension/add', [EmployeeController::class, 'add_employee_suspension']) 
    ->name('add_employee_suspension');

    Route::post('/employee/suspension/save', [EmployeeController::class, 'save_employee_suspension']) 
    ->name('save_employee_suspension');

    Route::post('/employee/suspension/edit', [EmployeeController::class, 'edit_employee_suspension']) 
    ->name('edit_employee_suspension');

    Route::post('/employee/suspension/update', [EmployeeController::class, 'update_employee_suspension']) 
    ->name('update_employee_suspension');

    Route::post('/employee/suspension/delete', [EmployeeController::class, 'delete_employee_suspension']) 
    ->name('delete_employee_suspension');

    Route::get('/employee/suspension/trash', [EmployeeController::class, 'trash_employee_suspension']) 
    ->name('trash_employee_suspension');

    Route::post('/employee/suspension/restor-delete', [EmployeeController::class, 'restore_employee_suspension']) 
    ->name('restore_employee_suspension');

    Route::post('/employee/suspension/delete-status', [EmployeeController::class, 'delete_employee_suspension_status']) 
    ->name('delete_employee_suspension_status');

    Route::post('/employee/suspension/view', [EmployeeController::class, 'view_employee_suspension']) 
    ->name('view_employee_suspension');

    //renewals
    Route::get('/employee/renewals', [EmployeeController::class, 'employee_renewals']) 
    ->name('employee_renewals');
    
    Route::get('/employee/renewals/history', [EmployeeController::class, 'employee_renewals_history']) 
    ->name('employee_renewals_history');

    Route::post('/employee/renewals/history/clear', [EmployeeController::class, 'employee_renewals_history_clear']) 
    ->name('employee_renewals_history_clear');

    Route::get('/employee/renewals/add', [EmployeeController::class, 'add_employee_renewals']) 
    ->name('add_employee_renewals');

    Route::post('/employee/renewals/save', [EmployeeController::class, 'save_employee_renewals']) 
    ->name('save_employee_renewals');

    Route::post('/employee/renewals/edit', [EmployeeController::class, 'edit_employee_renewals']) 
    ->name('edit_employee_renewals');

    Route::post('/employee/renewals/update', [EmployeeController::class, 'update_employee_renewals']) 
    ->name('update_employee_renewals');

    Route::post('/employee/renewals/delete', [EmployeeController::class, 'delete_employee_renewals']) 
    ->name('delete_employee_renewals');

    Route::get('/employee/renewals/trash', [EmployeeController::class, 'trash_employee_renewals']) 
    ->name('trash_employee_renewals');

    Route::post('/employee/renewals/restor-delete', [EmployeeController::class, 'restore_employee_renewals']) 
    ->name('restore_employee_renewals');

    Route::post('/employee/renewals/delete-status', [EmployeeController::class, 'delete_employee_renewals_status']) 
    ->name('delete_employee_renewals_status');

    Route::post('/employee/renewals/view', [EmployeeController::class, 'view_employee_renewals']) 
    ->name('view_employee_renewals');

    //increments

    Route::get('/employee/increments', [EmployeeController::class, 'employee_increments']) 
    ->name('employee_increments');

    Route::get('/employee/increments/history', [EmployeeController::class, 'employee_increments_history']) 
    ->name('employee_increments_history');

    Route::post('/employee/increments/history/clear', [EmployeeController::class, 'employee_increments_history_clear']) 
    ->name('employee_increments_history_clear');

    Route::get('/employee/increments/add', [EmployeeController::class, 'add_employee_increments']) 
    ->name('add_employee_increments');

    Route::post('/employee/increments/save', [EmployeeController::class, 'save_employee_increments']) 
    ->name('save_employee_increments');

    Route::post('/employee/increments/edit', [EmployeeController::class, 'edit_employee_increments']) 
    ->name('edit_employee_increments');

    Route::post('/employee/increments/update', [EmployeeController::class, 'update_employee_increments']) 
    ->name('update_employee_increments');

    Route::post('/employee/increments/delete', [EmployeeController::class, 'delete_employee_increments']) 
    ->name('delete_employee_increments');

    Route::get('/employee/increments/trash', [EmployeeController::class, 'trash_employee_increments']) 
    ->name('trash_employee_increments');

    Route::post('/employee/increments/restor-delete', [EmployeeController::class, 'restore_employee_increments']) 
    ->name('restore_employee_increments');

    Route::post('/employee/increments/delete-status', [EmployeeController::class, 'delete_employee_increments_status']) 
    ->name('delete_employee_increments_status');

    Route::post('/employee/increments/view', [EmployeeController::class, 'view_employee_increments']) 
    ->name('view_employee_increments');

    //deduction

    Route::get('/employee/deduction', [EmployeeController::class, 'employee_deduction']) 
    ->name('employee_deduction');

    Route::get('/employee/deduction/history', [EmployeeController::class, 'employee_deduction_history']) 
    ->name('employee_deduction_history');

    Route::post('/employee/deduction/history/clear', [EmployeeController::class, 'employee_deduction_history_clear']) 
    ->name('employee_deduction_history_clear');

    Route::get('/employee/deduction/add', [EmployeeController::class, 'add_employee_deduction']) 
    ->name('add_employee_deduction');

    Route::post('/employee/deduction/save', [EmployeeController::class, 'save_employee_deduction']) 
    ->name('save_employee_deduction');

    Route::post('/employee/deduction/edit', [EmployeeController::class, 'edit_employee_deduction']) 
    ->name('edit_employee_deduction');

    Route::post('/employee/deduction/update', [EmployeeController::class, 'update_employee_deduction']) 
    ->name('update_employee_deduction');

    Route::post('/employee/deduction/delete', [EmployeeController::class, 'delete_employee_deduction']) 
    ->name('delete_employee_deduction');

    Route::get('/employee/deduction/trash', [EmployeeController::class, 'trash_employee_deduction']) 
    ->name('trash_employee_deduction');

    Route::post('/employee/deduction/restor-delete', [EmployeeController::class, 'restore_employee_deduction']) 
    ->name('restore_employee_deduction');

    Route::post('/employee/deduction/delete-status', [EmployeeController::class, 'delete_employee_deduction_status']) 
    ->name('delete_employee_deduction_status');

    Route::post('/employee/deduction/view', [EmployeeController::class, 'view_employee_deduction']) 
    ->name('view_employee_deduction');

    //employee funds
    //increments

    Route::get('/employee/funds', [EmployeeController::class, 'employee_funds']) 
    ->name('employee_funds');

    Route::get('/employee/funds/history', [EmployeeController::class, 'employee_funds_history']) 
    ->name('employee_funds_history');

    Route::post('/employee/funds/history/clear', [EmployeeController::class, 'employee_funds_history_clear']) 
    ->name('employee_funds_history_clear');

    Route::get('/employee/funds/add', [EmployeeController::class, 'add_employee_funds']) 
    ->name('add_employee_funds');

    Route::post('/employee/funds/save', [EmployeeController::class, 'save_employee_funds']) 
    ->name('save_employee_funds');

    Route::post('/employee/funds/edit', [EmployeeController::class, 'edit_employee_funds']) 
    ->name('edit_employee_funds');

    Route::post('/employee/funds/update', [EmployeeController::class, 'update_employee_funds']) 
    ->name('update_employee_funds');

    Route::post('/employee/funds/delete', [EmployeeController::class, 'delete_employee_funds']) 
    ->name('delete_employee_funds');

    Route::get('/employee/funds/trash', [EmployeeController::class, 'trash_employee_funds']) 
    ->name('trash_employee_funds');

    Route::post('/employee/funds/restor-delete', [EmployeeController::class, 'restore_employee_funds']) 
    ->name('restore_employee_funds');

    Route::post('/employee/funds/delete-status', [EmployeeController::class, 'delete_employee_funds_status']) 
    ->name('delete_employee_funds_status');

    Route::post('/employee/funds/view', [EmployeeController::class, 'view_employee_funds']) 
    ->name('view_employee_funds');


   


    //handover submission

    Route::get('/employee/handover_submission', [EmployeeController::class, 'employee_handover_submission']) 
    ->name('employee_handover_submission');

    Route::get('/employee/other', [EmployeeController::class, 'employee_other']) 
    ->name('employee_other');
    Route::get('/employee/other/tickets', [EmployeeController::class, 'employee_other_tickets']) 
    ->name('employee_other_tickets');


    Route::get('/employee-salaries', [Hr_ProController::class, 'hr_pro']) 
    ->name('employee_salaries');

    //complaints
    Route::get('/complaints', [EmployeeController::class, 'complaints']) 
    ->name('complaints');

    
    

    Route::get('/complaints/history', [EmployeeController::class, 'complaints_history']) 
    ->name('complaints_history');

    Route::post('/complaints/history/clear', [EmployeeController::class, 'complaints_history_clear']) 
    ->name('complaints_history_clear');

    Route::get('/complaints/add', [EmployeeController::class, 'add_complaints']) 
    ->name('add_complaints');

    Route::post('/complaints/save', [EmployeeController::class, 'save_complaints']) 
    ->name('save_complaints');

    Route::post('/complaints/edit', [EmployeeController::class, 'edit_complaints']) 
    ->name('edit_complaints');

    Route::post('/complaints/update', [EmployeeController::class, 'update_complaints']) 
    ->name('update_complaints');

    Route::post('/complaints/delete', [EmployeeController::class, 'delete_complaints']) 
    ->name('delete_complaints');

    Route::get('/complaints/trash', [EmployeeController::class, 'trash_complaints']) 
    ->name('trash_complaints');

    Route::post('/complaints/restor-delete', [EmployeeController::class, 'restore_complaints']) 
    ->name('restore_complaints');

    Route::post('/complaints/delete-status', [EmployeeController::class, 'delete_complaints_status']) 
    ->name('delete_complaints_status');

    Route::post('/complaints/view', [EmployeeController::class, 'view_complaints']) 
    ->name('view_complaints');
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

    //Trade license partner
    /////
        
    Route::get('/trade-license-partners/{id}/', [Hr_ProController::class, 'trade_license_partners']) 
    ->name('trade_license_partners');

    Route::get('/trade-license-partners/add/{id}', [Hr_ProController::class, 'trade_license_partners_add']) 
    ->name('trade_license_partners_add');

    Route::post('/trade-license-partners/save', [Hr_ProController::class, 'save_trade_license_partners']) 
        ->name('save_trade_license_partners');
    
    Route::post('/trade-license-partners/update', [Hr_ProController::class, 'update_trade_license_partners']) 
    ->name('update_trade_license_partners');

    Route::post('/trade-license-partners/edit', [Hr_ProController::class, 'edit_trade_license_partners']) 
    ->name('edit_trade_license_partners');

    Route::post('/trade-license-partners/delete', [Hr_ProController::class, 'delete_trade_license_partners']) 
    ->name('delete_trade_license_partners');

    Route::get('/trade-license-partners/trash/all', [Hr_ProController::class, 'trash_trade_license_partners']) 
    ->name('trash_trade_license_partners');

    Route::post('/trade-license-partners/restor-delete', [Hr_ProController::class, 'restore_trade_license_partners']) 
    ->name('restore_trade_license_partners');

    Route::post('/trade-license-partners/delete-status', [Hr_ProController::class, 'delete_trade_license_partners_status']) 
    ->name('delete_trade_license_partners_status');

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
        Route::get('/mobiles-fuel-tanks-renewals/trained-individual', [Hr_ProController::class, 'mobiles_trained_individual']) 
     ->name('mobile_trained_individual');

        Route::get('/mobiles-fuel-tanks-renewals/trained-individual/history', [Hr_ProController::class, 'mobiles_trained_individual_history']) 
        ->name('mobile_trained_individual_history');

        Route::post('/mobiles-fuel-tanks-renewals/trained-individual/history/clear', [Hr_ProController::class, 'mobiles_trained_individual_history_clear']) 
        ->name('mobile_trained_individual_history_clear');

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