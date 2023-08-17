<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/login')->group(function () {
    Route::get('', [AdministratorController::class, 'login'])->name('adm.login');
    Route::post('', [AdministratorController::class, 'login']);
});

Route::prefix('/register')->group(function () {
    Route::get('', [AdministratorController::class, 'register'])->name('adm.register');
    Route::post('', [AdministratorController::class, 'register']);
});


Route::prefix('/movies')->middleware('auth')->group(function () {
    Route::get('add', [MovieController::class, 'add'])->name('adm.movie.add');
    Route::post('add', [MovieController::class, 'add']);
    Route::get('list', [MovieController::class, 'listADM'])->name('adm.movie.list');
    Route::post('list', [MovieController::class, 'listADM']);
});

Route::get('/movie', function () {
    return view('adm.movie.add');
});
