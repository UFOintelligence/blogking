<?php
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {


    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->
        middleware(['can:Acceso al dashboard'])->name('dashboard');
    });
    

Route::resource('/categories', CategoryController::class)->except('show')
->middleware(['can:Gestion de categorias']);

Route::resource('/posts', PostController::class)->except('show')
->middleware(['can:Gestion de articulos']);
Route::resource('/dashboard', DashboardController::class)->except('show')
->middleware(['can:Gestion de dashboard']);

Route::resource('/roles', RoleController::class)->except('show')
->middleware(['can:Gestion de roles']);

Route::resource('/permission', permissionController::class)->except('show')
->middleware(['can:Gestion de permisos']);

Route::resource('/users', UserController::class)->except('show', 'create', 'store')
->middleware(['can:Gestion de usuarios']);

});