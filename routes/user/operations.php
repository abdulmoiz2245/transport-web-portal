<?php 
use App\Http\Controllers\user\userController;

use App\Http\Controllers\User\OperationsController;


use Illuminate\Support\Facades\Route;

Route::get('/employee/operations', [OperationsController::class, 'operations']) 
->name('user.operations');

Route::get('employee/operations/attendence', [OperationsController::class, 'employee_attendence']) 
->name('user.operations.employee_attendence');

Route::get('employee/operations/attendence/mark/{date?}', [OperationsController::class, 'employee_attendence_mark']) 
->name('user.operations.employee_attendence_mark');

Route::get('employee/operations/attendence/report/{date?}', [OperationsController::class, 'employee_attendence_report']) 
->name('user.operations.employee_attendence_report');

Route::post('employee/operations/employee-attendance/save', [OperationsController::class, 'save_employee_attendance']) 
->name('user.operations.save_employee_attendance');

Route::get('employee/operations/attendence/leave', [OperationsController::class, 'employee_leave']) 
->name('user.operations.employee_leave');

Route::get('employee/operations/attendence/leave/history', [OperationsController::class, 'employee_leave_history']) 
->name('user.operations.employee_leave_history');

Route::post('employee/operations/attendence/leave/history/clear', [OperationsController::class, 'employee_leave_history_clear']) 
->name('user.operations.employee_leave_history_clear');

Route::get('employee/operations/attendence/leave/add', [OperationsController::class, 'add_employee_leave']) 
->name('user.operations.add_employee_leave');

Route::post('employee/operations/attendence/leave/save', [OperationsController::class, 'save_employee_leave']) 
->name('user.operations.save_employee_leave');

Route::post('employee/operations/attendence/leave/edit', [OperationsController::class, 'edit_employee_leave']) 
->name('user.operations.edit_employee_leave');

Route::post('employee/operations/attendence/leave/update', [OperationsController::class, 'update_employee_leave']) 
->name('user.operations.update_employee_leave');

Route::post('employee/operations/attendence/leave/delete', [OperationsController::class, 'delete_employee_leave']) 
->name('user.operations.delete_employee_leave');

Route::get('employee/operations/attendence/leave/trash', [OperationsController::class, 'trash_employee_leave']) 
->name('user.operations.trash_employee_leave');

Route::post('employee/operations/attendence/leave/restor-delete', [OperationsController::class, 'restore_employee_leave']) 
->name('user.operations.restore_employee_leave');

Route::post('employee/operations/attendence/leave/delete-status', [OperationsController::class, 'delete_employee_leave_status']) 
->name('user.operations.delete_employee_leave_status');

Route::post('employee/operations/attendence/leave/view', [OperationsController::class, 'view_employee_leave']) 
->name('user.operations.view_employee_leave');

//attendance absent request
Route::get('employee/operations/attendence/absent', [OperationsController::class, 'employee_absent']) 
->name('user.operations.employee_absent');

//complaints
Route::get('employee/operations/complaints', [OperationsController::class, 'complaints']) 
->name('user.operations.complaints');

Route::get('employee/operations/complaints/history', [OperationsController::class, 'complaints_history']) 
->name('user.operations.complaints_history');

Route::post('employee/operations/complaints/history/clear', [OperationsController::class, 'complaints_history_clear']) 
->name('user.operations.complaints_history_clear');

Route::get('employee/operations/complaints/add', [OperationsController::class, 'add_complaints']) 
->name('user.operations.add_complaints');

Route::post('employee/operations/complaints/save', [OperationsController::class, 'save_complaints']) 
->name('user.operations.save_complaints');

Route::post('employee/operations/complaints/edit', [OperationsController::class, 'edit_complaints']) 
->name('user.operations.edit_complaints');

Route::post('employee/operations/complaints/update', [OperationsController::class, 'update_complaints']) 
->name('user.operations.update_complaints');

Route::post('employee/operations/complaints/delete', [OperationsController::class, 'delete_complaints']) 
->name('user.operations.delete_complaints');

Route::get('employee/operations/complaints/trash', [OperationsController::class, 'trash_complaints']) 
->name('user.operations.trash_complaints');

Route::post('employee/operations/complaints/restor-delete', [OperationsController::class, 'restore_complaints']) 
->name('user.operations.restore_complaints');

Route::post('employee/operations/complaints/delete-status', [OperationsController::class, 'delete_complaints_status']) 
->name('user.operations.delete_complaints_status');

Route::post('employee/operations/complaints/view', [OperationsController::class, 'view_complaints']) 
->name('user.operations.view_complaints');

//Absent
Route::get('employee/operations/absent', [OperationsController::class, 'absent']) 
->name('user.operations.absent');

Route::get('employee/operations/absent/history', [OperationsController::class, 'absent_history']) 
->name('user.operations.absent_history');

Route::post('employee/operations/absent/history/clear', [OperationsController::class, 'absent_history_clear']) 
->name('user.operations.absent_history_clear');

Route::get('employee/operations/absent/add', [OperationsController::class, 'add_absent']) 
->name('user.operations.add_absent');

Route::post('employee/operations/absent/save', [OperationsController::class, 'save_absent']) 
->name('user.operations.save_absent');

Route::post('employee/operations/absent/edit', [OperationsController::class, 'edit_absent']) 
->name('user.operations.edit_absent');

Route::post('employee/operations/absent/update', [OperationsController::class, 'update_absent']) 
->name('user.operations.update_absent');

Route::post('employee/operations/absent/delete', [OperationsController::class, 'delete_absent']) 
->name('user.operations.delete_absent');

Route::get('employee/operations/absent/trash', [OperationsController::class, 'trash_absent']) 
->name('user.operations.trash_absent');

Route::post('employee/operations/absent/restor-delete', [OperationsController::class, 'restore_absent']) 
->name('user.operations.restore_absent');

Route::post('employee/operations/absent/delete-status', [OperationsController::class, 'delete_absent_status']) 
->name('user.operations.delete_absent_status');

Route::post('employee/operations/absent/view', [OperationsController::class, 'view_absent']) 
->name('user.operations.view_absent');


//Booking
Route::get('employee/operations/booking/new', [OperationsController::class, 'new_booking']) 
->name('user.operations.new_booking');

Route::post('employee/operations/booking/new-normal-booking', [OperationsController::class, 'new_normal_booking']) 
->name('user.operations.new_normal_booking');

Route::post('employee/operations/booking/view', [OperationsController::class, 'view_booking']) 
->name('user.operations.view_booking');

Route::post('employee/operations/booking/save/new-normal-booking', [OperationsController::class, 'save_new_booking']) 
->name('user.operations.save_new_booking');

Route::get('employee/operations/booking/history', [OperationsController::class, 'booking_history']) 
->name('user.operations.booking_history');

Route::get('employee/operations/booking/trash', [OperationsController::class, 'trash_booking']) 
->name('user.operations.trash_booking');

Route::post('employee/operations/booking/delete-status', [OperationsController::class, 'delete_booking_status']) 
->name('user.operations.delete_booking_status');

Route::get('employee/operations/booking/trash', [OperationsController::class, 'trash_booking']) 
->name('user.operations.trash_booking');

Route::post('employee/operations/booking/restore', [OperationsController::class, 'restore_booking']) 
->name('user.operations.restore_booking');

Route::post('employee/operations/booking/status-update', [OperationsController::class, 'booking_status_update']) 
->name('user.operations.booking_status_update');

Route::get('employee/operations/booking/manage', [OperationsController::class, 'manage_booking']) 
->name('user.operations.manage_booking');

Route::get('employee/operations/booking/pending', [OperationsController::class, 'pending_booking']) 
->name('user.operations.pending_booking');

Route::post('employee/operations/booking/save-booking-document', [OperationsController::class, 'save_booking_document']) 
->name('user.operations.save_booking_document');

Route::get('employee/operations/booking/rejected', [OperationsController::class, 'rejected_booking']) 
->name('user.operations.rejected_booking');

Route::get('employee/operations/booking/processed', [OperationsController::class, 'processed_booking']) 
->name('user.operations.processed_booking');

Route::get('employee/operations/booking/get-booking', [OperationsController::class, 'get_booking']) 
->name('user.operations.get_booking');

Route::post('employee/operations/vehicle/view_vehicle', [OperationsController::class, 'view_vehicle']) 
->name('user.operations.view_vehicle');

Route::get('employee/operations/fleet/vehicle', [OperationsController::class, 'vehicle_fleet']) 
->name('user.operations.vehicle_fleet');

Route::get('employee/operations/fleet/trailer', [OperationsController::class, 'trailer_fleet']) 
->name('user.operations.trailer_fleet');

// Route::get('/fleet/vehicle/history', [OperationsController::class, 'vehicle_history']) 
// ->name('vehicle_history');

// Route::get('/fleet/vehicle/trash', [OperationsController::class, 'trash_vehicle']) 
// ->name('trash_vehicle');

// Route::post('/fleet/vehicle/delete', [OperationsController::class, 'delete_vehicle_status']) 
// ->name('delete_vehicle_status');

Route::get('employee/operations/assign/vehicle', [OperationsController::class, 'assign_vehicle']) 
->name('user.operations.assign_vehicle');

Route::post('employee/operations/assign/vehicle/save', [OperationsController::class, 'assign_vehicle_save']) 
->name('user.operations.assign_vehicle_save');

Route::get('employee/operations/unassign/vehicle/{assign_id}', [OperationsController::class, 'unassign_vehicle']) 
->name('user.operations.unassign_vehicle');

Route::post('employee/operations/unassign/vehicle/save', [OperationsController::class, 'unassign_vehicle_save']) 
->name('user.operations.unassign_vehicle_save');

Route::post('employee/operations/assign/trailer/save', [OperationsController::class, 'assign_trailer_save']) 
->name('user.operations.assign_trailer_save');

Route::get('employee/operations/get-vehicle', [OperationsController::class, 'get_vehicle']) 
->name('user.operations.get_vehicle');

Route::post('employee/operations/assign_unassign/vehicle/view', [OperationsController::class, 'view_assigned_unassigned_vehicle']) 
->name('user.operations.view_assigned_unassigned_vehicle');

Route::get('employee/operations/vehicle/get_vehicle_driver', [OperationsController::class, 'get_vehicle_driver']) 
->name('user.operations.get_vehicle_driver');

Route::get('employee/operations/vehicle/assign/delete', [OperationsController::class, 'delete_assign_unassign_vehicle']) 
->name('user.operations.delete_assign_unassign_vehicle');