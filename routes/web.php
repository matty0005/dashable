<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Public\Dashboard;
use App\Http\Controllers\Auth\ConfigController;
use App\Http\Controllers\Auth\HomePageController;
use App\Http\Controllers\Auth\ImageUploaderController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard/{dashboardId}', [Dashboard::class, 'index']);

Route::get('/dashboard', [HomePageController::class, 'index'])->name('dashboard')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
Route::post('/dashboard', [HomePageController::class, 'update'])->name('dashboard_update')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');

Route::get('/customize', [ConfigController::class, 'index'])->name('customize')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
Route::post('/customize', [ConfigController::class, 'update'])->name('customize_update')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');


Route::get('/images', [ImageUploaderController::class, 'index'])->name('images')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
Route::post('/images/upload', [ImageUploaderController::class, 'store'])->name('images')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');

Route::get('/ftp_read', [HomePageController::class, 'ftp_read'])->name('dashboard')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
