<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SpatieManagerController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::name('admin.')->prefix('admin')->middleware(['role_or_permission:admin'])->group(function () {

    Route::get(
        '/roleupdate/{role}/{permission}/{value}',
        [SpatieManagerController::class, 'updateRolePermissions']
    )->name('rolepermissionupdates');

    Route::get(
        '/userroles/{userid}/{role}/{value}',
        [SpatieManagerController::class, 'updateUserRoles']
    )->name('userrolesupdates');

    Route::get(
        '/userpermissions{userid}/{permission}/{value}',
        [SpatieManagerController::class, 'updateUserPermissions']
    )->name('userpermissionsupdates');
});
