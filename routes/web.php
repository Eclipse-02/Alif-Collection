<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
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

Route::post('custom-login', [LoginController::class, 'customLogin'])->name('custom-login'); 

Route::get('/dashboard', [ModuleController::class, 'index'])->name('dashboard');
Route::get('/getMenu', [ModuleController::class, 'getMenu'])->name('getMenu');
Route::get('/getOutlet', [ModuleController::class, 'getOutlet'])->name('getOutlet');
Route::get('/dashboard/create', [ModuleController::class, 'create'])->name('dashboard.create');
Route::post('/dashboard/create', [ModuleController::class, 'store'])->name('dashboard.store');
Route::put('/dashboard', [ModuleController::class, 'update'])->name('dashboard.update');

Auth::routes([
    'register' => false
]);