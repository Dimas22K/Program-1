<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KemampuanLabController;
use App\Http\Controllers\IntervalController;

Route::get('/', function () {
    return view('index');
});

// Login
Route::get('/index', [AuthController::class, 'showindex'])->name('index');
Route::post('/index', [AuthController::class, 'index']);

// Chart User
Route::get('/chart-user', [AuthController::class, 'chartUser'])->name('chart.user');

// Chart Admin
Route::get('/chart-admin', [AuthController::class, 'chartAdmin'])->name('chart.admin');


// Chart Data (JSON untuk grafik admin)
Route::get('/chart-data', [AdminController::class, 'getChartData'])->name('chart.data');


// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin dashboard
/*Route::get('/admin', function () {
    return view('admin');
})->name('admin');*/
Route::get('/admin', [AuthController::class, 'adminDashboard'])->name('admin');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Dinamis: /data-mesin/kania atau /alat-ukur/kaprang, dll
Route::get('/{jenis}/{divisi}', [DivisiController::class, 'show'])
    ->where('jenis', 'data-mesin|alat-ukur')
    ->where('divisi', 'kania|kapsel|kaprang|harkan|rekum');

Route::prefix('admin')->group(function () {
    // index: /admin/data-mesin/kania
    Route::get('/{jenis}/{divisi}', [AdminController::class, 'index'])
        ->where('jenis', 'data-mesin|alat-ukur')
        ->where('divisi', 'kania|kapsel|kaprang|harkan|rekum')
        ->name('admin.divisi');

    // create
    Route::get('/{jenis}/{divisi}/create', [AdminController::class, 'create'])->name('admin.create');

    // store
    Route::post('/{jenis}/{divisi}/store', [AdminController::class, 'store'])->name('admin.store');

    // edit
    Route::get('/{jenis}/{divisi}/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    // update
    Route::put('/{jenis}/{divisi}/{id}', [AdminController::class, 'update'])->name('admin.update');

    // delete
    Route::delete('/{jenis}/{divisi}/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

Route::get('/kemampuanLab', [KemampuanLabController::class, 'index'])->name('kemampuanLab');
Route::get('/kemampuanLabAdmin', [KemampuanLabController::class, 'indexAdmin'])->name('kemampuanLabAdmin');

//interval kalibrasi
Route::get('/interval', [IntervalController::class, 'index'])->name('interval.index');
Route::get('/interval/create', [IntervalController::class, 'create'])->name('interval.create');
Route::post('/interval/store', [IntervalController::class, 'store'])->name('interval.store');
Route::get('/interval/{id}/edit', [IntervalController::class, 'edit'])->name('interval.edit');
Route::put('/interval/{id}', [IntervalController::class, 'update'])->name('interval.update');
Route::get('/interval/{id}/delete', [IntervalController::class, 'destroy'])->name('interval.delete');

Route::get('/admin/{jenis}/{divisi}/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/user/{jenis}/{divisi}/export', [AdminController::class, 'export'])->name('user.export');
Route::get('/user/{jenis}/{divisi}', [AdminController::class, 'index'])->name('user.index');