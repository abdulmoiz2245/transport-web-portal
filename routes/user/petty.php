<?php
use App\Http\Controllers\User\PettyController ;



use Illuminate\Support\Facades\Route;


Route::get('/employee/petty-cash', [PettyController::class, 'petty']) 
->name('user.petty');

Route::group(['prefix'=>'/employee/petty','as'=>'user.petty.'], function(){

    Route::get('/finance-request/finance-request', [PettyController::class, 'finance_request']) 
    ->name('finance_request');

    Route::get('/finance-request/finance-request/history', [PettyController::class, 'finance_request_history']) 
    ->name('finance_request_history');

    Route::post('/finance-request/finance-request/history/clear', [PettyController::class, 'finance_request_history_clear']) 
    ->name('finance_request_history_clear');

    Route::get('/finance-request/office/add', [PettyController::class, 'add_finance_request']) 
    ->name('add_finance_request');

    Route::post('/finance-request/finance-request/save', [PettyController::class, 'save_finance_request']) 
    ->name('save_finance_request');

    Route::post('/finance-request/finance-request/edit', [PettyController::class, 'edit_finance_request']) 
    ->name('edit_finance_request');

    Route::post('/finance-request/finance-request/update', [PettyController::class, 'update_finance_request']) 
    ->name('update_finance_request');

    Route::post('/finance-request/finance-request/delete', [PettyController::class, 'delete_finance_request']) 
    ->name('delete_finance_request');

    Route::get('/finance-request/finance-request/trash', [PettyController::class, 'trash_finance_request']) 
    ->name('trash_finance_request');

    Route::post('/finance-request/finance-request/restor-delete', [PettyController::class, 'restore_finance_request']) 
    ->name('restore_finance_request');

    Route::post('/finance-request/finance-request/delete-status', [PettyController::class, 'delete_finance_request_status']) 
    ->name('delete_finance_request_status');

    Route::post('/finance-request/finance-request/view', [PettyController::class, 'view_finance_request']) 
    ->name('view_finance_request');

    //Payable Purchase
    Route::get('/payable/purchase', [PettyController::class, 'payable_purchase']) 
    ->name('payable_purchase');

    Route::post('/payable/issue-purchase-payment', [PettyController::class, 'issue_purchase_payment']) 
    ->name('issue_purchase_payment');

    Route::post('/payable/update-purchase-status', [PettyController::class, 'update_purchase_status']) 
    ->name('update_purchase_status');

    //Payable HR
    Route::get('/payable/hr-fund', [PettyController::class, 'payable_hr']) 
    ->name('payable_hr');

    Route::post('/payable/issue-hr-payment', [PettyController::class, 'issue_hr_payment']) 
    ->name('issue_hr_payment');

    Route::post('/payable/update-hr-status', [PettyController::class, 'update_hr_status']) 
    ->name('update_hr_status');

    //Payable Fines
    Route::get('/payable/fine', [PettyController::class, 'payable_fine']) 
    ->name('payable_fine');

    //Payable bills
    Route::get('/payable/bill', [PettyController::class, 'payable_bill']) 
    ->name('payable_bill');

    Route::post('/payable/save-payable-bill', [PettyController::class, 'save_payable_bill']) 
    ->name('save_payable_bill');

    Route::post('/payable/update-payable-bill', [PettyController::class, 'update_bill_status']) 
    ->name('update_bill_status');
    //Detail
    Route::get('/detail', [PettyController::class, 'petty_detail']) 
    ->name('petty_detail');

    

});
