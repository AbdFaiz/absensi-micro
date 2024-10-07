<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// absen
Route::get('/absen/create', [AbsenController::class, 'create'])->name('absens.create');
Route::post('/absen/store', [AbsenController::class, 'store'])->name('absens.store');

// report
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
Route::get('reports/search', [ReportController::class, 'search'])->name('reports.search');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/absens', [AbsenController::class, 'index'])->name('absens.index');
    Route::get('absens/{id}/edit', [AbsenController::class, 'edit'])->name('absens.edit');
    Route::put('absens/{id}', [AbsenController::class, 'update'])->name('absens.update');
    Route::delete('absens/{id}', [AbsenController::class, 'destroy'])->name('absens.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // name
    Route::get('names', [NameController::class, 'index'])->name('names.index');
    Route::get('names/create', [NameController::class, 'create'])->name('names.create');
    Route::post('names', [NameController::class, 'store'])->name('names.store');
    Route::get('names/{id}/edit', [NameController::class, 'edit'])->name('names.edit');
    Route::put('names/{id}', [NameController::class, 'update'])->name('names.update');
    Route::delete('names/{id}', [NameController::class, 'destroy'])->name('names.destroy');
});