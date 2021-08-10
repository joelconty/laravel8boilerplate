<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;


Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum', 'role_or_permission:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/roles', [UserController::class, 'roles'])->name('users.roles');
    Route::post('/users/updateroles', [UserController::class, 'updateroles'])->name('users.updateroles');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/{id}/delete', [RoleController::class, 'delete'])->name('roles.delete');
    Route::post('/roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{id}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::post('/roles/updatepermissions', [RoleController::class, 'updatepermissions'])->name('roles.updatepermissions');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permissions/{id}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
    Route::post('/permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

});
