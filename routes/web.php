<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Guru\GuruAbsensiController;
use App\Http\Controllers\Api\AbsensiApiController;

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

// Root redirect
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Super Admin']], function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/monthly-stats', [DashboardController::class, 'getMonthlyStats'])->name('dashboard.monthly-stats');
    Route::get('/dashboard/absensi-per-kelas', [DashboardController::class, 'getAbsensiPerKelas'])->name('dashboard.absensi-per-kelas');
    Route::get('/dashboard/notifications', [DashboardController::class, 'getNotifications'])->name('dashboard.notifications');
    Route::get('/dashboard/realtime', [DashboardController::class, 'getRealTimeData'])->name('dashboard.realtime');
    Route::post('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.settings');
    Route::get('/dashboard/export', [DashboardController::class, 'exportDashboard'])->name('dashboard.export');

    // Manajemen Siswa
    Route::group(['prefix' => 'siswa', 'as' => 'siswa.'], function () {
        Route::get('/', [SiswaController::class, 'index'])->name('index');
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/', [SiswaController::class, 'store'])->name('store');
        Route::get('/{nis}', [SiswaController::class, 'show'])->name('show');
        Route::get('/{nis}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{nis}', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{nis}', [SiswaController::class, 'destroy'])->name('destroy');
        Route::get('/{nis}/qr-code', [SiswaController::class, 'generateQRCode'])->name('qr-code');
        Route::post('/import', [SiswaController::class, 'import'])->name('import');
        Route::get('/export/excel', [SiswaController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [SiswaController::class, 'exportPdf'])->name('export.pdf');
        Route::post('/bulk-delete', [SiswaController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Manajemen User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{nip}', [UserController::class, 'show'])->name('show');
        Route::get('/{nip}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{nip}', [UserController::class, 'update'])->name('update');
        Route::delete('/{nip}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{nip}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
        Route::post('/{nip}/assign-role', [UserController::class, 'assignRole'])->name('assign-role');
        Route::delete('/{nip}/remove-role/{roleId}', [UserController::class, 'removeRole'])->name('remove-role');
        Route::get('/export/excel', [UserController::class, 'exportExcel'])->name('export.excel');
        Route::post('/bulk-delete', [UserController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Manajemen Kelas
    Route::group(['prefix' => 'kelas', 'as' => 'kelas.'], function () {
        Route::get('/', [KelasController::class, 'index'])->name('index');
        Route::get('/create', [KelasController::class, 'create'])->name('create');
        Route::post('/', [KelasController::class, 'store'])->name('store');
        Route::get('/{namaKelas}', [KelasController::class, 'show'])->name('show');
        Route::get('/{namaKelas}/edit', [KelasController::class, 'edit'])->name('edit');
        Route::put('/{namaKelas}', [KelasController::class, 'update'])->name('update');
        Route::delete('/{namaKelas}', [KelasController::class, 'destroy'])->name('destroy');
        Route::get('/{namaKelas}/siswa', [KelasController::class, 'getSiswa'])->name('siswa');
        Route::get('/{namaKelas}/absensi', [KelasController::class, 'getAbsensi'])->name('absensi');
        Route::post('/bulk-delete', [KelasController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Manajemen Role
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{roleId}', [RoleController::class, 'show'])->name('show');
        Route::get('/{roleId}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{roleId}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/{roleId}/users', [RoleController::class, 'getUsers'])->name('users');
    });

    // Manajemen Absensi
    Route::group(['prefix' => 'absensi', 'as' => 'absensi.'], function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('index');
        Route::get('/create', [AbsensiController::class, 'create'])->name('create');
        Route::post('/', [AbsensiController::class, 'store'])->name('store');
        Route::get('/{kodeAbsensi}', [AbsensiController::class, 'show'])->name('show');
        Route::get('/{kodeAbsensi}/edit', [AbsensiController::class, 'edit'])->name('edit');
        Route::put('/{kodeAbsensi}', [AbsensiController::class, 'update'])->name('update');
        Route::delete('/{kodeAbsensi}', [AbsensiController::class, 'destroy'])->name('destroy');
        Route::get('/filter/date', [AbsensiController::class, 'filterByDate'])->name('filter.date');
        Route::get('/filter/kelas', [AbsensiController::class, 'filterByKelas'])->name('filter.kelas');
        Route::get('/filter/status', [AbsensiController::class, 'filterByStatus'])->name('filter.status');
        Route::post('/scan-qr', [AbsensiController::class, 'scanQR'])->name('scan-qr');
        Route::post('/manual-input', [AbsensiController::class, 'manualInput'])->name('manual-input');
        Route::get '/export/excel', [AbsensiController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [AbsensiController::class, 'exportPdf'])->name('export.pdf');
        Route::post('/bulk-delete', [AbsensiController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Laporan
    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('/harian', [LaporanController::class, 'harian'])->name('harian');
        Route::get('/mingguan', [LaporanController::class, 'mingguan'])->name('mingguan');
        Route::get('/bulanan', [LaporanController::class, 'bulanan'])->name('bulanan');
        Route::get('/semester', [LaporanController::class, 'semester'])->name('semester');
        Route::get('/tahunan', [LaporanController::class, 'tahunan'])->name('tahunan');
        Route::get('/per-siswa', [LaporanController::class, 'perSiswa'])->name('per-siswa');
        Route::get('/per-kelas', [LaporanController::class, 'perKelas'])->name('per-kelas');
        Route::get('/rekap-absensi', [LaporanController::class, 'rekapAbsensi'])->name('rekap-absensi');
        Route::get('/siswa-bermasalah', [LaporanController::class, 'siswaBermasalah'])->name('siswa-bermasalah');
        Route::get('/terlambat', [LaporanController::class, 'terlambat'])->name('terlambat');
        Route::post('/generate', [LaporanController::class, 'generate'])->name('generate');
        Route::get('/export/{type}/{format}', [LaporanController::class, 'export'])->name('export');
    });

    // Pengaturan Sistem
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/general', [SettingsController::class, 'general'])->name('general');
        Route::post('/general', [SettingsController::class, 'updateGeneral'])->name('general.update');
        Route::get('/absensi', [SettingsController::class, 'absensi'])->name('absensi');
        Route::post('/absensi', [SettingsController::class, 'updateAbsensi'])->name('absensi.update');
        Route::get('/notification', [SettingsController::class, 'notification'])->name('notification');
        Route::post('/notification', [SettingsController::class, 'updateNotification'])->name('notification.update');
        Route::get('/backup', [SettingsController::class, 'backup'])->name('backup');
        Route::post('/backup/create', [SettingsController::class, 'createBackup'])->name('backup.create');
        Route::get('/backup/download/{file}', [SettingsController::class, 'downloadBackup'])->name('backup.download');
        Route::delete('/backup/{file}', [SettingsController::class, 'deleteBackup'])->name('backup.delete');
    });

    // Log Aktivitas
    Route::get('/logs', [SettingsController::class, 'logs'])->name('logs');
    Route::delete('/logs/clear', [SettingsController::class, 'clearLogs'])->name('logs.clear');

    // Export Data
    Route::get('/export', [SettingsController::class, 'exportPage'])->name('export');
    Route::post('/export/all', [SettingsController::class, 'exportAll'])->name('export.all');
});

/*
|--------------------------------------------------------------------------
| Guru/Staff Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'guru', 'as' => 'guru.', 'middleware' => ['auth', 'role:Admin,Guru Matapelajaran,Walikelas,Kesiswaan']], function () {
    
    // Dashboard Guru
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/my-stats', [GuruDashboardController::class, 'getMyStats'])->name('dashboard.my-stats');

    // Absensi Guru
    Route::group(['prefix' => 'absensi', 'as' => 'absensi.'], function () {
        Route::get('/', [GuruAbsensiController::class, 'index'])->name('index');
        Route::get('/create', [GuruAbsensiController::class, 'create'])->name('create');
        Route::post('/', [GuruAbsensiController::class, 'store'])->name('store');
        Route::get('/{kodeAbsensi}', [GuruAbsensiController::class, 'show'])->name('show');
        Route::get('/{kodeAbsensi}/edit', [GuruAbsensiController::class, 'edit'])->name('edit');
        Route::put('/{kodeAbsensi}', [GuruAbsensiController::class, 'update'])->name('update');
        Route::post('/scan-qr', [GuruAbsensiController::class, 'scanQR'])->name('scan-qr');
        Route::get('/kelas/{namaKelas}', [GuruAbsensiController::class, 'byKelas'])->name('kelas');
    });

    // Laporan untuk Guru
    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('/my-records', [GuruAbsensiController::class, 'myRecords'])->name('my-records');
        Route::get('/kelas-saya', [GuruAbsensiController::class, 'kelasSaya'])->name('kelas-saya');
    });
});

/*
|--------------------------------------------------------------------------
| API Routes for Mobile/AJAX
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api/v1', 'as' => 'api.', 'middleware' => 'auth:sanctum'], function () {
    
    // Absensi API
    Route::group(['prefix' => 'absensi', 'as' => 'absensi.'], function () {
        Route::post('/scan', [AbsensiApiController::class, 'scanQR'])->name('scan');
        Route::post('/manual', [AbsensiApiController::class, 'manualInput'])->name('manual');
        Route::get('/today', [AbsensiApiController::class, 'today'])->name('today');
        Route::get('/history/{nis}', [AbsensiApiController::class, 'history'])->name('history');
        Route::get('/stats', [AbsensiApiController::class, 'stats'])->name('stats');
    });

    // Siswa API
    Route::group(['prefix' => 'siswa', 'as' => 'siswa.'], function () {
        Route::get('/search', [AbsensiApiController::class, 'searchSiswa'])->name('search');
        Route::get('/{nis}/qr', [AbsensiApiController::class, 'getQRCode'])->name('qr');
    });

    // Kelas API
    Route::get('/kelas', [AbsensiApiController::class, 'getKelas'])->name('kelas');
    Route::get('/kelas/{namaKelas}/siswa', [AbsensiApiController::class, 'getSiswaByKelas'])->name('kelas.siswa');
});

/*
|--------------------------------------------------------------------------
| Public Routes (for QR Code scanning, etc.)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'public'], function () {
    Route::get('/qr/{nis}', function ($nis) {
        // Generate QR Code untuk siswa
        return response()->view('public.qr-code', compact('nis'));
    })->name('public.qr');
    
    Route::get('/check-qr/{data}', [AbsensiApiController::class, 'checkQRData'])->name('public.check-qr');
});

/*
|--------------------------------------------------------------------------
| Fallback Routes
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

/*
|--------------------------------------------------------------------------
| Route Model Binding
|--------------------------------------------------------------------------
*/
Route::bind('nis', function ($value) {
    return \App\Models\Siswa::where('NIS', $value)->firstOrFail();
});

Route::bind('nip', function ($value) {
    return \App\Models\User::where('NIP', $value)->firstOrFail();
});

Route::bind('namaKelas', function ($value) {
    return \App\Models\Kelas::where('NamaKelas', $value)->firstOrFail();
});

Route::bind('roleId', function ($value) {
    return \App\Models\Role::findOrFail($value);
});

Route::bind('kodeAbsensi', function ($value) {
    return \App\Models\Absensi::where('Kode_Absensi', $value)->firstOrFail();
});