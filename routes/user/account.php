<?php
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\User\AccountController ;




use Illuminate\Support\Facades\Route;
    Route::get('/employee/account', [AccountController::class, 'account']) 
    ->name('user.account');
    Route::group(['prefix'=>'/employee/account','as'=>'user.account.'], function(){
        
    Route::get('/approvals', [AccountController::class, 'approval']) 
    ->name('approval');

    Route::get('/approvals/history', [AccountController::class, 'approval_history']) 
    ->name('approval_history');

    Route::post('/approvals/history/clear', [AccountController::class, 'approval_history_clear']) 
    ->name('approval_history_clear');

    Route::get('/approvals/add', [AccountController::class, 'add_approval']) 
    ->name('add_approval');

    Route::post('/approvals/save', [AccountController::class, 'save_approval']) 
    ->name('save_approval');

    Route::post('/approvals/edit', [AccountController::class, 'edit_approval']) 
    ->name('edit_approval');

    Route::post('/approvals/update', [AccountController::class, 'update_approval']) 
    ->name('update_approval');

    Route::post('/approvals/delete', [AccountController::class, 'delete_approval']) 
    ->name('delete_approval');

    Route::get('/approvals/trash', [AccountController::class, 'trash_approval']) 
    ->name('trash_approval');

    Route::post('/approvals/restor-delete', [AccountController::class, 'restore_approval']) 
    ->name('restore_approval');

    Route::post('/approvals/delete-status', [AccountController::class, 'delete_approval_status']) 
    ->name('delete_approval_status');

    Route::post('/approvals/view', [AccountController::class, 'view_approval']) 
    ->name('view_approval');

    //Account Petty
    Route::get('/payable/petty', [AccountController::class, 'payable_petty']) 
    ->name('payable_petty');

    //Account Payable
    Route::get('/payable/purchase', [AccountController::class, 'payable_purchase']) 
    ->name('payable_purchase');

    Route::get('/payable/booking', [AccountController::class, 'payable_booking']) 
    ->name('payable_booking');

    Route::get('/payable/hr-fund', [AccountController::class, 'payable_hr_fund']) 
    ->name('payable_hr_fund');

    Route::get('/payable/petty-fund', [AccountController::class, 'payable_petty_fund']) 
    ->name('payable_petty_fund');

    Route::post('/cheque/issue/purchase', [AccountController::class, 'cheque_issue_purchase']) 
    ->name('cheque_issue_purchase');

    Route::post('/cheque/issue/booking', [AccountController::class, 'cheque_issue_booking']) 
    ->name('cheque_issue_booking');

    Route::post('/petty/payable/purchase', [AccountController::class, 'pay_by_petty_purchase']) 
    ->name('pay_by_petty_purchase');

    Route::post('/petty/payable/booking', [AccountController::class, 'pay_by_petty_booking']) 
    ->name('pay_by_petty_booking');

    Route::post('/petty/payable/hr', [AccountController::class, 'pay_by_petty_hr']) 
    ->name('pay_by_petty_hr');

    Route::post('/cheque/issue/hr-fund', [AccountController::class, 'cheque_issue_hr_fund']) 
    ->name('cheque_issue_hr_fund');

    Route::post('/cheque/issue/booking', [AccountController::class, 'cheque_issue_booking']) 
    ->name('cheque_issue_booking');


    Route::post('/cheque/issue/petty-fund', [AccountController::class, 'cheque_issue_petty_fund']) 
    ->name('cheque_issue_petty_fund');

    //Cheque
    Route::get('/cheque', [AccountController::class, 'cheque']) 
    ->name('cheque');
    Route::get('/cheque/purchase', [AccountController::class, 'cheque_purchase']) 
    ->name('cheque_purchase');

    Route::get('/cheque/booking', [AccountController::class, 'cheque_booking']) 
    ->name('cheque_booking');

    Route::get('/cheque/petty', [AccountController::class, 'cheque_petty']) 
    ->name('cheque_petty');


    Route::get('/cheque/hr-fund', [AccountController::class, 'cheque_hr_fund']) 
    ->name('cheque_hr_fund');

    Route::post('/cheque/update', [AccountController::class, 'update_cheque']) 
    ->name('update_cheque');

    Route::post('/cheque/view', [AccountController::class, 'view_cheque']) 
    ->name('view_cheque');

    //Account Paid
    Route::get('/paid/purchase', [AccountController::class, 'paid_purchase']) 
    ->name('paid_purchase');

    Route::get('/paid/booking', [AccountController::class, 'paid_booking']) 
    ->name('paid_booking');

    Route::get('/paid/hr-fund', [AccountController::class, 'paid_hr_fund']) 
    ->name('paid_hr_fund');

    //Account Invoice
    Route::get('/invoice', [AccountController::class, 'invoice']) 
    ->name('invoice');

    Route::get('/invoice/approval', [AccountController::class, 'invoice_approval']) 
    ->name('invoice_approval');

    Route::get('/invoice/all', [AccountController::class, 'all_invoice']) 
    ->name('all_invoice');

    Route::post('/invoice/new', [AccountController::class, 'new_invoice']) 
    ->name('new_invoice');

    Route::post('/invoice/save', [AccountController::class, 'save_invoice']) 
    ->name('save_invoice');

    Route::post('/invoice/view', [AccountController::class, 'view_invoice']) 
    ->name('view_invoice');

    Route::get('/paid/hr-fund', [AccountController::class, 'paid_hr_fund']) 
    ->name('paid_hr_fund');

    //Account Invoice Reciveable
    Route::get('/reciveable/invoice', [AccountController::class, 'reciveable_invoice']) 
    ->name('reciveable_invoice');

    Route::get('/reciveable/invoice/over-due', [AccountController::class, 'reciveable_invoice_over_due']) 
    ->name('reciveable_invoice_over_due');

    Route::get('/reciveable', [AccountController::class, 'reciveable']) 
    ->name('reciveable');
    Route::get('/recived/invoice', [AccountController::class, 'recived_invoice']) 
    ->name('recived_invoice');

    Route::post('/reciveable/recive_payment', [AccountController::class, 'recive_invoice_payment']) 
    ->name('recive_invoice_payment');

    Route::get('/invoice/history', [AccountController::class, 'invoice_history']) 
    ->name('invoice_history');

    Route::get('/invoice/discard', [AccountController::class, 'discard_invoice']) 
    ->name('discard_invoice');
});