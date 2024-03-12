<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
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



Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', [TaskController::class, 'index']);

    Route::get('/dash', [TaskController::class, 'dashboard'])
        ->middleware('is_admin')
        ->name('admin');

    Route::post('/task', [TaskController::class, 'addTask']);

    Route::delete('/task/{id}', [TaskController::class, 'deleteTask']);
});

Auth::routes();

Route::post('/logout', [LoginController::class,'logout'])->name('logout');
