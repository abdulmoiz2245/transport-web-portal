<?php 
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\User\OperationsController;


use Illuminate\Support\Facades\Route;

Route::get('/operations', [OperationsController::class, 'operations']) 
->name('user.operations');

Route::get('/operations/attendence', [OperationsController::class, 'employee_attendence']) 
->name('user.operations.employee_attendence');

Route::get('/operations/attendence/mark/{date?}', [OperationsController::class, 'employee_attendence_mark']) 
->name('user.operations.employee_attendence_mark');

Route::get('/operations/attendence/report/{date?}', [OperationsController::class, 'employee_attendence_report']) 
->name('user.operations.employee_attendence_report');

Route::post('/operations/employee-attendance/save', [OperationsController::class, 'save_employee_attendance']) 
->name('user.operations.save_employee_attendance');

Route::get('/operations/attendence/leave', [OperationsController::class, 'employee_leave']) 
->name('user.operations.employee_leave');




Route::get('/operations/attendence/leave/history', [OperationsController::class, 'employee_leave_history']) 
->name('user.operations.employee_leave_history');

Route::post('/operations/attendence/leave/history/clear', [OperationsController::class, 'employee_leave_history_clear']) 
->name('user.operations.employee_leave_history_clear');

Route::get('/operations/attendence/leave/add', [OperationsController::class, 'add_employee_leave']) 
->name('user.operations.add_employee_leave');

Route::post('/operations/attendence/leave/save', [OperationsController::class, 'save_employee_leave']) 
->name('user.operations.save_employee_leave');

Route::post('/operations/attendence/leave/edit', [OperationsController::class, 'edit_employee_leave']) 
->name('user.operations.edit_employee_leave');

Route::post('/operations/attendence/leave/update', [OperationsController::class, 'update_employee_leave']) 
->name('user.operations.update_employee_leave');

Route::post('/operations/attendence/leave/delete', [OperationsController::class, 'delete_employee_leave']) 
->name('user.operations.delete_employee_leave');

Route::get('/operations/attendence/leave/trash', [OperationsController::class, 'trash_employee_leave']) 
->name('user.operations.trash_employee_leave');

Route::post('/operations/attendence/leave/restor-delete', [OperationsController::class, 'restore_employee_leave']) 
->name('user.operations.restore_employee_leave');

Route::post('/operations/attendence/leave/delete-status', [OperationsController::class, 'delete_employee_leave_status']) 
->name('user.operations.delete_employee_leave_status');

Route::post('/operations/attendence/leave/view', [OperationsController::class, 'view_employee_leave']) 
->name('user.operations.view_employee_leave');

//attendance absent request
Route::get('/operations/attendence/absent', [OperationsController::class, 'employee_absent']) 
->name('user.operations.employee_absent');

//complaints
Route::get('/operations/complaints', [OperationsController::class, 'complaints']) 
->name('user.operations.complaints');




Route::get('/operations/complaints/history', [OperationsController::class, 'complaints_history']) 
->name('user.operations.complaints_history');

Route::post('/operations/complaints/history/clear', [OperationsController::class, 'complaints_history_clear']) 
->name('user.operations.complaints_history_clear');

Route::get('/operations/complaints/add', [OperationsController::class, 'add_complaints']) 
->name('user.operations.add_complaints');

Route::post('/operations/complaints/save', [OperationsController::class, 'save_complaints']) 
->name('user.operations.save_complaints');

Route::post('/operations/complaints/edit', [OperationsController::class, 'edit_complaints']) 
->name('user.operations.edit_complaints');

Route::post('/operations/complaints/update', [OperationsController::class, 'update_complaints']) 
->name('user.operations.update_complaints');

Route::post('/operations/complaints/delete', [OperationsController::class, 'delete_complaints']) 
->name('user.operations.delete_complaints');

Route::get('/operations/complaints/trash', [OperationsController::class, 'trash_complaints']) 
->name('user.operations.trash_complaints');

Route::post('/operations/complaints/restor-delete', [OperationsController::class, 'restore_complaints']) 
->name('user.operations.restore_complaints');

Route::post('/operations/complaints/delete-status', [OperationsController::class, 'delete_complaints_status']) 
->name('user.operations.delete_complaints_status');

Route::post('/operations/complaints/view', [OperationsController::class, 'view_complaints']) 
->name('user.operations.view_complaints');
