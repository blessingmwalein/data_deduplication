<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FileReportController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', [FileController::class, 'adminIndex']);
    Route::get('/dashboard',[FileController::class, 'adminIndex']);
    Route::get('/admin/reports',[FileController::class, 'adminFileReport']);
    Route::get('/admin/files',[FolderController::class, 'adminIndex']);
    Route::get('/user/dashboard', [FileController::class, 'userDash'])->name('user.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/files', [FileController::class, 'userIndex'])->name('user.files');

    Route::resource('/user/files', FileController::class)->except(['create', 'edit', 'index', 'update']);
    Route::post('/user/files/{file}', [FileController::class, 'update']);
    Route::get('/admin/downloadExcel', [FileReportController::class, 'export']);
    Route::post('users', [UserController::class, 'store']);
    Route::post('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    Route::resource('/user/folder', FolderController::class)->except(['create', 'edit', 'index']);
});
