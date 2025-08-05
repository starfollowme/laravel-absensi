<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua halaman untuk Guru dan Walikelas tanpa prefix
|--------------------------------------------------------------------------
*/

// ==================== GURU ====================
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/guru-dashboard', function () {
    return view('guru.dashboardguru');
})->name('guru.dashboard');

Route::get('/guru-formlogin', function () {
    return view('guru.formLogin');
})->name('guru.login');

Route::get('/guru-login', function () {
    return view('guru.formLoginGuru');
})->name('guru.login');

Route::get('/guru-scanqr', function () {
    return view('guru.scanqr');
})->name('guru.scanqr');


// ==================== WALIKELAS ====================
Route::get('/walikelas-dashboard', function () {
    return view('walikelas.dashboard');
})->name('walikelas.dashboard');

Route::get('/walikelas-login', function () {
    return view('walikelas.formlogin');
})->name('walikelas.login');

Route::get('/walikelas-scanqr', function () {
    return view('walikelas.scanqr');
})->name('walikelas.scanqr');

Route::get('/walikelas-index', function () {
    return view('walikelas.index');
})->name('walikelas.index');


