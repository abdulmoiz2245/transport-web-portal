<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Hr_ProController as Admin_Hr_ProController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Hr_ProController;



use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin'])->group(function () {

    //profile
    Route::get('/admin', [AdminController::class, 'dashboard'])
                ->name('admin.dashboard');

    Route::get('/admin/setting/profile', [AdminController::class, 'admin_profile'])
                ->name('admin.setting.profile');

    Route::post('/admin/update-profile', [AdminController::class, 'update_profile'])
                ->name('admin.update.profile');

    //roles
    Route::get('/admin/setting/roles', [AdminController::class, 'roles'])
    ->name('admin.setting.role');

    Route::get('/admin/setting/add-roles', [AdminController::class, 'add_role'])
    ->name('admin.setting.add_role');
    
    Route::post('/admin/setting/edit-role', [AdminController::class, 'edit_role'])
    ->name('admin.setting.edit_role');

    Route::post('/admin/setting/update-role', [AdminController::class, 'update_role'])
    ->name('admin.setting.update_role');

    Route::post('/admin/setting/delete-role', [AdminController::class, 'delete_role'])
    ->name('admin.setting.delete_role');


    Route::post('/admin/setting/save-roles', [AdminController::class, 'save_role'])
    ->name('admin.setting.save_role');

    //permissions
      Route::post('/admin/setting/permission', [AdminController::class, 'permission'])
    ->name('admin.setting.permission');

    Route::post('/admin/setting/permission-update', [AdminController::class, 'permission_update'])->name('admin.setting.permission-update');


    //Users
    Route::get('/admin/add-user' , [AdminController::class, 'add_user'])->name('admin.add_user');

    Route::post('/admin/save-user' , [AdminController::class, 'save_user'])->name('admin.save_user');
    
    Route::get('/admin/users' , [AdminController::class, 'list_users'])->name('admin.users');
    Route::post('/admin/edit-user' , [AdminController::class, 'edit_user'])->name('admin.edit_user');
    Route::post('/admin/delete-user' , [AdminController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/admin/update-users' , [AdminController::class, 'update_user'])->name('admin.update.user');

    require __DIR__.'/hr_pro.php';
    require __DIR__.'/customer.php';
    require __DIR__.'/supplier.php';
    require __DIR__.'/sub_contractor.php';
    require __DIR__.'/purchase.php';



    

   
});

?>