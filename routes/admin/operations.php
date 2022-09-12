<?php 
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\OperationsController;


use Illuminate\Support\Facades\Route;

Route::get('/admin/operations', [OperationsController::class, 'operations']) 
->name('admin.operations');

Route::get('admin/operations/attendence', [OperationsController::class, 'employee_attendence']) 
->name('admin.operations.employee_attendence');

Route::get('admin/operations/attendence/mark/{date?}', [OperationsController::class, 'employee_attendence_mark']) 
->name('admin.operations.employee_attendence_mark');

Route::get('admin/operations/attendence/report/{date?}', [OperationsController::class, 'employee_attendence_report']) 
->name('admin.operations.employee_attendence_report');

Route::post('admin/operations/employee-attendance/save', [OperationsController::class, 'save_employee_attendance']) 
->name('admin.operations.save_employee_attendance');

Route::get('admin/operations/attendence/leave', [OperationsController::class, 'employee_leave']) 
->name('admin.operations.employee_leave');

Route::get('admin/operations/attendence/leave/history', [OperationsController::class, 'employee_leave_history']) 
->name('admin.operations.employee_leave_history');

Route::post('admin/operations/attendence/leave/history/clear', [OperationsController::class, 'employee_leave_history_clear']) 
->name('admin.operations.employee_leave_history_clear');

Route::get('admin/operations/attendence/leave/add', [OperationsController::class, 'add_employee_leave']) 
->name('admin.operations.add_employee_leave');

Route::post('admin/operations/attendence/leave/save', [OperationsController::class, 'save_employee_leave']) 
->name('admin.operations.save_employee_leave');

Route::post('admin/operations/attendence/leave/edit', [OperationsController::class, 'edit_employee_leave']) 
->name('admin.operations.edit_employee_leave');

Route::post('admin/operations/attendence/leave/update', [OperationsController::class, 'update_employee_leave']) 
->name('admin.operations.update_employee_leave');

Route::post('admin/operations/attendence/leave/delete', [OperationsController::class, 'delete_employee_leave']) 
->name('admin.operations.delete_employee_leave');

Route::get('admin/operations/attendence/leave/trash', [OperationsController::class, 'trash_employee_leave']) 
->name('admin.operations.trash_employee_leave');

Route::post('admin/operations/attendence/leave/restor-delete', [OperationsController::class, 'restore_employee_leave']) 
->name('admin.operations.restore_employee_leave');

Route::post('admin/operations/attendence/leave/delete-status', [OperationsController::class, 'delete_employee_leave_status']) 
->name('admin.operations.delete_employee_leave_status');

Route::post('admin/operations/attendence/leave/view', [OperationsController::class, 'view_employee_leave']) 
->name('admin.operations.view_employee_leave');

//attendance absent request
Route::get('admin/operations/attendence/absent', [OperationsController::class, 'employee_absent']) 
->name('admin.operations.employee_absent');

//complaints
Route::get('admin/operations/complaints', [OperationsController::class, 'complaints']) 
->name('admin.operations.complaints');

Route::get('admin/operations/complaints/history', [OperationsController::class, 'complaints_history']) 
->name('admin.operations.complaints_history');

Route::post('admin/operations/complaints/history/clear', [OperationsController::class, 'complaints_history_clear']) 
->name('admin.operations.complaints_history_clear');

Route::get('admin/operations/complaints/add', [OperationsController::class, 'add_complaints']) 
->name('admin.operations.add_complaints');

Route::post('admin/operations/complaints/save', [OperationsController::class, 'save_complaints']) 
->name('admin.operations.save_complaints');

Route::post('admin/operations/complaints/edit', [OperationsController::class, 'edit_complaints']) 
->name('admin.operations.edit_complaints');

Route::post('admin/operations/complaints/update', [OperationsController::class, 'update_complaints']) 
->name('admin.operations.update_complaints');

Route::post('admin/operations/complaints/delete', [OperationsController::class, 'delete_complaints']) 
->name('admin.operations.delete_complaints');

Route::get('admin/operations/complaints/trash', [OperationsController::class, 'trash_complaints']) 
->name('admin.operations.trash_complaints');

Route::post('admin/operations/complaints/restor-delete', [OperationsController::class, 'restore_complaints']) 
->name('admin.operations.restore_complaints');

Route::post('admin/operations/complaints/delete-status', [OperationsController::class, 'delete_complaints_status']) 
->name('admin.operations.delete_complaints_status');

Route::post('admin/operations/complaints/view', [OperationsController::class, 'view_complaints']) 
->name('admin.operations.view_complaints');

//Absent
Route::get('admin/operations/absent', [OperationsController::class, 'absent']) 
->name('admin.operations.absent');

Route::get('admin/operations/absent/history', [OperationsController::class, 'absent_history']) 
->name('admin.operations.absent_history');

Route::post('admin/operations/absent/history/clear', [OperationsController::class, 'absent_history_clear']) 
->name('admin.operations.absent_history_clear');

Route::get('admin/operations/absent/add', [OperationsController::class, 'add_absent']) 
->name('admin.operations.add_absent');

Route::post('admin/operations/absent/save', [OperationsController::class, 'save_absent']) 
->name('admin.operations.save_absent');

Route::post('admin/operations/absent/edit', [OperationsController::class, 'edit_absent']) 
->name('admin.operations.edit_absent');

Route::post('admin/operations/absent/update', [OperationsController::class, 'update_absent']) 
->name('admin.operations.update_absent');

Route::post('admin/operations/absent/delete', [OperationsController::class, 'delete_absent']) 
->name('admin.operations.delete_absent');

Route::get('admin/operations/absent/trash', [OperationsController::class, 'trash_absent']) 
->name('admin.operations.trash_absent');

Route::post('admin/operations/absent/restor-delete', [OperationsController::class, 'restore_absent']) 
->name('admin.operations.restore_absent');

Route::post('admin/operations/absent/delete-status', [OperationsController::class, 'delete_absent_status']) 
->name('admin.operations.delete_absent_status');

Route::post('admin/operations/absent/view', [OperationsController::class, 'view_absent']) 
->name('admin.operations.view_absent');


//Booking
Route::get('admin/operations/booking/new', [OperationsController::class, 'new_booking']) 
->name('admin.operations.new_booking');

Route::post('admin/operations/booking/new-normal-booking', [OperationsController::class, 'new_normal_booking']) 
->name('admin.operations.new_normal_booking');

Route::post('admin/operations/booking/new-otj-booking', [OperationsController::class, 'new_otj_booking']) 
->name('admin.operations.new_otj_booking');


Route::post('admin/operations/booking/view', [OperationsController::class, 'view_booking']) 
->name('admin.operations.view_booking');

Route::post('admin/operations/booking/save/new-normal-booking', [OperationsController::class, 'save_new_booking']) 
->name('admin.operations.save_new_booking');

Route::get('admin/operations/booking/history', [OperationsController::class, 'booking_history']) 
->name('admin.operations.booking_history');

Route::get('admin/operations/booking/trash', [OperationsController::class, 'trash_booking']) 
->name('admin.operations.trash_booking');

Route::post('admin/operations/booking/delete-status', [OperationsController::class, 'delete_booking_status']) 
->name('admin.operations.delete_booking_status');

Route::post('admin/operations/booking/restore', [OperationsController::class, 'restore_booking']) 
->name('admin.operations.restore_booking');

Route::post('admin/operations/booking/status-update', [OperationsController::class, 'booking_status_update']) 
->name('admin.operations.booking_status_update');

Route::get('admin/operations/booking/manage', [OperationsController::class, 'manage_booking']) 
->name('admin.operations.manage_booking');

Route::get('admin/operations/booking/pending', [OperationsController::class, 'pending_booking']) 
->name('admin.operations.pending_booking');

Route::post('admin/operations/booking/save-booking-document', [OperationsController::class, 'save_booking_document']) 
->name('admin.operations.save_booking_document');

Route::get('admin/operations/booking/rejected', [OperationsController::class, 'rejected_booking']) 
->name('admin.operations.rejected_booking');

Route::get('admin/operations/booking/processed', [OperationsController::class, 'processed_booking']) 
->name('admin.operations.processed_booking');

Route::get('admin/operations/booking/get-booking', [OperationsController::class, 'get_booking']) 
->name('admin.operations.get_booking');

Route::post('admin/operations/vehicle/view_vehicle', [OperationsController::class, 'view_vehicle']) 
->name('admin.operations.view_vehicle');

Route::get('admin/operations/fleet/vehicle', [OperationsController::class, 'vehicle_fleet']) 
->name('admin.operations.vehicle_fleet');

Route::get('admin/operations/fleet/trailer', [OperationsController::class, 'trailer_fleet']) 
->name('admin.operations.trailer_fleet');

// Route::get('/fleet/vehicle/history', [OperationsController::class, 'vehicle_history']) 
// ->name('vehicle_history');

// Route::get('/fleet/vehicle/trash', [OperationsController::class, 'trash_vehicle']) 
// ->name('trash_vehicle');

// Route::post('/fleet/vehicle/delete', [OperationsController::class, 'delete_vehicle_status']) 
// ->name('delete_vehicle_status');

Route::get('admin/operations/assign/vehicle', [OperationsController::class, 'assign_vehicle']) 
->name('admin.operations.assign_vehicle');

Route::post('admin/operations/assign/vehicle/save', [OperationsController::class, 'assign_vehicle_save']) 
->name('admin.operations.assign_vehicle_save');

Route::get('admin/operations/unassign/vehicle/{assign_id}', [OperationsController::class, 'unassign_vehicle']) 
->name('admin.operations.unassign_vehicle');

Route::post('admin/operations/unassign/vehicle/save', [OperationsController::class, 'unassign_vehicle_save']) 
->name('admin.operations.unassign_vehicle_save');

Route::post('admin/operations/assign/trailer/save', [OperationsController::class, 'assign_trailer_save']) 
->name('admin.operations.assign_trailer_save');

Route::get('admin/operations/get-vehicle', [OperationsController::class, 'get_vehicle']) 
->name('admin.operations.get_vehicle');

Route::post('admin/operations/assign_unassign/vehicle/view', [OperationsController::class, 'view_assigned_unassigned_vehicle']) 
->name('admin.operations.view_assigned_unassigned_vehicle');

Route::get('admin/operations/vehicle/get_vehicle_driver', [OperationsController::class, 'get_vehicle_driver']) 
->name('admin.operations.get_vehicle_driver');

Route::get('admin/operations/vehicle/assign/delete', [OperationsController::class, 'delete_assign_unassign_vehicle']) 
->name('admin.operations.delete_assign_unassign_vehicle');