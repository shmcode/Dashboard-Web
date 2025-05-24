<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\ReportCitizenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');
Route::resource('cities', CityController::class);

Route::get('/citizens', [CitizenController::class, 'index'])->name('citizens.index');
Route::get('/citizens/create', [CitizenController::class, 'create'])->name('citizens.create');
Route::post('/citizens/store', [CitizenController::class, 'store'])->name('citizens.store');
Route::resource('citizens', CitizenController::class);

Route::get('/send-report', [ReportCitizenController::class, 'send_report'])->middleware(['auth'])->name('report.send_report');
Route::get('/citizens-by-city', [ReportCitizenController::class, 'index'])->middleware(['auth'])->name('report.citizens-by-city');
require __DIR__.'/auth.php';