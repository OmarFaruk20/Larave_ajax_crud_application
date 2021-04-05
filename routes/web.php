<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('/');
Route::post('task/store', [App\Http\Controllers\TaskController::class, 'store'])->name('task.store');
Route::get('task/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
Route::post('task/update/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
Route::post('task/delete/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task.delete');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
