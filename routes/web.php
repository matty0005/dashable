<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Public\Dashboard;
use App\Http\Controllers\Auth\ConfigController;
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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });


Route::get('/dashboard/{dashboardId}', [Dashboard::class, 'index']);

Route::get('/dashboard', [ConfigController::class, 'index'])->name('dashboard')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
Route::post('/dashboard', [ConfigController::class, 'update'])->name('dashboard_update')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');

//
Route::get('/customize', function () {
    return Inertia::render('Customize');
})->name('customize')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');


Route::get('/images', [ImageUploaderController::class, 'index'])->name('images')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
Route::post('/images/upload', [ImageUploaderController::class, 'store'])->name('images')->middleware('auth:sanctum', config('jetstream.auth_session'),'verified');
