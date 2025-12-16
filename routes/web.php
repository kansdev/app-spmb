<?php

use App\Http\Controllers\admin\AdminController;
use App\Models\IdCard;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\users\DashboardController;
use App\Http\Controllers\users\FormulirOrangTuaController;
use App\Http\Controllers\users\FormulirSiswaController;
use App\Http\Controllers\users\FormulirPeriodik;
use App\Http\Controllers\users\FormulirRegistrasi;
use App\Http\Controllers\users\FormulirNilaiRaport;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

// Root direct to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login
Route::get('/login', [AuthController::class, 'login_page'])->name('login');

// Redirect ke google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route credentials admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/login', [AuthController::class, 'login_admin'])->name('admin_login');

Route::get('/admin/grafik', [AdminController::class, 'grafik'])->name('admin.grafik');
Route::get('/admin/pendaftar', [AdminController::class, 'pendaftar'])->name('admin.pendaftar');

// Middleware untuk akun
Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/akun', [DashboardController::class, 'akun'])->name('akun');
    Route::post('/akun/update', [DashboardController::class, 'update_akun'])->name('update_akun');
});

// Middleware untuk formulir siswa
Route::middleware(['auth', 'preventBackHistory', 'checkProfile'])->group(function () {
    // Formulir orang tua
    Route::get('/formulir_siswa', [FormulirSiswaController::class, 'index'])->name('formulir_siswa');
    Route::post('/formulir_siswa/save', [FormulirSiswaController::class, 'save_siswa'])->name('save_siswa');
});

// Middleware untuk formulir orang tua
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa'])->group(function () {
    // Formulir orang tua
    Route::get('/formulir_orang_tua', [FormulirOrangTuaController::class, 'index'])->name('formulir_orang_tua');
    Route::post('/formulir_orang_tua/save', [FormulirOrangTuaController::class, 'save_orang_tua'])->name('save_orang_tua');
});

// Midleware untuk formulir periodik
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua'])->group(function () {
    // Formulir Periodik
    Route::get('/formulir_periodik', [FormulirPeriodik::class, 'index'])->name('formulir_periodik');
    Route::post('/formulir_periodik/save', [FormulirPeriodik::class, 'save_periodik'])->name('save_periodik');
});

// Middleware formulir untuk upload berkas dan id_card
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua', 'checkDataPeriodik'])->group(function () {
    // route nilai raport
    Route::get('/formulir_nilai_raport', [FormulirNilaiRaport::class, 'index'])->name('formulir_nilai_raport');
    Route::post('/formulir_nilai_raport/save', [FormulirNilaiRaport::class, 'save_nilai_raport'])->name('save_nilai_raport');

});

Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua', 'checkDataPeriodik', 'checkNilaiRaport'])->group(function () {
    // Upload Berkas
    Route::get('/upload_berkas', function () {
        return view('uploads.index', ['user' => Auth::user()]);
    })->name('upload_berkas');

    // ID Card
    Route::get('/id_card', function () {
        return view('id-card.index');
    })->name('id_card');

    // cetak ID Card
    Route::get('/idcard/pdf/{id}', function ($id) {
        $item = IdCard::findOrFail($id);
        $width = 8.56 * 28.3465; // 242.5pt
        $height = 5.4 * 28.3465; // 153.1pt
        $pdf = Pdf::loadView('id-card.template', compact('item'))
            ->setPaper([0, 0, $height, $width], 'potrait');

        return $pdf->stream('idcard_' . $item->nama . '.pdf');
    });
});


// Middleware untuk formulir registrasi
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua', 'checkDataPeriodik','checkUploadBerkas'])->group(function () {
    // Formulir Registrasi
    Route::get('/formulir_registrasi', [FormulirRegistrasi::class, 'index'])->name('formulir_registrasi');
    Route::post('/formulir_registrasi/save', [FormulirRegistrasi::class, 'save_registrasi'])->name('save_formulir_registrasi');
});

// Logout Sistem
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
