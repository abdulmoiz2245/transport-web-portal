<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AccountController ;




use Illuminate\Support\Facades\Route;

    Route::group(['prefix'=>'/admin/account','as'=>'admin.account.'], function(){
        Route::get('/', [AccountController::class, 'account']) 
        ->name('account');

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

    //Account Payable
    Route::get('/payable/purchase', [AccountController::class, 'payable_purchase']) 
    ->name('payable_purchase');

    Route::get('/payable/hr-fund', [AccountController::class, 'payable_hr_fund']) 
    ->name('payable_hr_fund');

    Route::get('/payable/petty-fund', [AccountController::class, 'payable_petty_fund']) 
    ->name('payable_petty_fund');

    Route::post('/cheque/issue/purchase', [AccountController::class, 'cheque_issue_purchase']) 
    ->name('cheque_issue_purchase');

    Route::post('/cheque/issue/hr-fund', [AccountController::class, 'cheque_issue_hr_fund']) 
    ->name('cheque_issue_hr_fund');

    Route::post('/cheque/issue/petty-fund', [AccountController::class, 'cheque_issue_petty_fund']) 
    ->name('cheque_issue_petty_fund');

    //Cheque
    Route::get('/cheque', [AccountController::class, 'cheque']) 
    ->name('cheque');
    Route::get('/cheque/purchase', [AccountController::class, 'cheque_purchase']) 
    ->name('cheque_purchase');

    Route::get('/cheque/hr-fund', [AccountController::class, 'cheque_hr_fund']) 
    ->name('cheque_hr_fund');

    Route::post('/cheque/update', [AccountController::class, 'update_cheque']) 
    ->name('update_cheque');

    Route::post('/cheque/view', [AccountController::class, 'view_cheque']) 
    ->name('view_cheque');

    //Account Paid
    Route::get('/paid/purchase', [AccountController::class, 'paid_purchase']) 
    ->name('paid_purchase');

    Route::get('/paid/hr-fund', [AccountController::class, 'paid_hr_fund']) 
    ->name('paid_hr_fund');
});