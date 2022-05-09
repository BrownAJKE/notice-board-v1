<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('notice-board');
});

Auth::routes();

Route::get('/notice-board', [App\Http\Controllers\NoticeBoardController::class, 'index'])->name('notice-board');

Route::resource('notice', App\Http\Controllers\NoticeBoardController::class);

Route::middleware(['auth',])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/notice/approve/{notice}', [App\Http\Controllers\NoticeBoardController::class, 'approveNotice'])->name('approve-notice');
});
