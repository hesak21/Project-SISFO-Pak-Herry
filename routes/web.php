<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Route untuk Autentikasi (Login & Logout) menggunakan Laravel UI
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Route Resource untuk Master Data Kelas
Route::resource('kelas', KelasController::class);

// Route Resource untuk Master Data Siswa
Route::resource('siswa', SiswaController::class);

// Route Resource untuk Master Data Guru
Route::resource('guru', GuruController::class);

// Route Resource untuk Master Data Mata Pelajaran (Mapel)
Route::resource('mapel', MapelController::class);

// Route Resource untuk Data Nilai Akademik
Route::resource('nilai', NilaiController::class);