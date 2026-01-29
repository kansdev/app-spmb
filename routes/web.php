<?php

use App\Http\Controllers\admin\AdminController;
use App\Exports\PendaftarExport;
use App\Models\IdCard;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\users\CekPendaftarController;
use App\Http\Controllers\users\DashboardController;
use App\Http\Controllers\users\FormulirOrangTuaController;
use App\Http\Controllers\users\FormulirSiswaController;
use App\Http\Controllers\users\FormulirPeriodik;
use App\Http\Controllers\users\FormulirRegistrasi;
use App\Http\Controllers\users\FormulirNilaiRaport;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

// Root direct to login page
Route::get('/', function () {
    return view('landing.index');
});

// Halaman Login
// Redirect ke google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route credentials admin
Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login_admin'])->name('admin_login');

Route::middleware(['cekAdmin'])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/grafik', [AdminController::class, 'grafik'])->name('admin.grafik');
    Route::get('/admin/grafik_agama', [AdminController::class, 'grafik_agama'])->name('admin.grafik_agama');
    Route::get('/admin/pendaftar', [AdminController::class, 'pendaftar'])->name('admin.pendaftar');
    Route::get('/admin/data_pendaftar', [AdminController::class, 'data_pendaftar'])->name('admin.data_pendaftar');
    Route::get('/admin/data_ditolak', [AdminController::class, 'data_ditolak'])->name('admin.data_ditolak');
    Route::get('/admin/pendaftar/{id}/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::post('/admin/pendaftar/{id}/tolak_verifikasi', [AdminController::class, 'tolak_verifikasi'])->name('admin.ditolak');
    Route::delete('/admin/delete/akun/{id}', [AdminController::class, 'delete_akun'])->name('admin.delete_akun');
    Route::delete('admin/hapus_berkas/{id}', [AdminController::class, 'hapus_berkas'])->name('admin.hapus_berkas');

    // Route ajax
    Route::get('/admin/dashboard/data-calon-pendaftar', [AdminController::class, 'data_calon_pendaftar']);
    Route::get('/admin/dashboard/data-user', [AdminController::class, 'data_user'])->name('admin.dashboard.data_user');
    Route::get('/admin/dashboard/statistik', function() {
        return response()->json([
            'akun' => \App\Models\User::count(),
            'calon' => \App\Models\User::whereDoesntHave('registrasi')->count(),
            'pendaftar' => \App\Models\Registrasi::count()
        ]);
    });
    Route::get('/admin/dashboard/data-teregistrasi', [AdminController::class, 'data_teregistrasi']);
    Route::get('/admin/dashboard/data-teregistrasi/test', [AdminController::class, 'data_teregistrasi']);
});

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
    Route::put('/formulir_siswa/edit/{siswa}', [FormulirSiswaController::class, 'edit_siswa'])->name('edit_siswa');
});

// Middleware untuk formulir orang tua
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa'])->group(function () {
    // Formulir orang tua
    Route::get('/formulir_orang_tua', [FormulirOrangTuaController::class, 'index'])->name('formulir_orang_tua');
    Route::post('/formulir_orang_tua/save', [FormulirOrangTuaController::class, 'save_orang_tua'])->name('save_orang_tua');
    Route::put('/formulir_orang_tua/edit/{orang_tua}', [FormulirOrangTuaController::class, 'edit_orang_tua'])->name('edit_orang_tua');
});

// Midleware untuk formulir periodik
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua'])->group(function () {
    // Formulir Periodik
    Route::get('/formulir_periodik', [FormulirPeriodik::class, 'index'])->name('formulir_periodik');
    Route::post('/formulir_periodik/save', [FormulirPeriodik::class, 'save_periodik'])->name('save_periodik');
    Route::put('/formulir_periodik/edit/{periodik}', [FormulirPeriodik::class, 'edit_periodik'])->name('edit_periodik');
});

// Middleware formulir untuk upload berkas dan id_card
Route::middleware(['auth', 'preventBackHistory', 'checkProfile', 'checkDataSiswa', 'checkDataOrangTua', 'checkDataPeriodik'])->group(function () {
    // route nilai raport
    Route::get('/formulir_nilai_raport', [FormulirNilaiRaport::class, 'index'])->name('formulir_nilai_raport');
    Route::post('/formulir_nilai_raport/save', [FormulirNilaiRaport::class, 'save_nilai_raport'])->name('save_nilai_raport');
    Route::put('/formulir_nilai_raport/edit/{nilai_raport}', [FormulirNilaiRaport::class, 'edit_nilai_raport'])->name('edit_nilai_raport');

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

Route::get('/cekpendaftar/{registrasi}', [CekPendaftarController::class, 'show'])->name('cek_pendaftar')->middleware('signed');

// Logout Sistem
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Test
Route::get('/api/k6-login', function (Request $request) {
    $admin = DB::table('account')->where('username', 'admin')->first();

    if (!$admin) {
        return response()->json([
            'ok' => false,
            'message' => 'User tidak ditemukan'
        ], 401);
    }

    if (!Hash::check('Smknusantara1!', $admin->password)) {
        return response()->json([
            'ok' => false,
            'message' => 'Password salah'
        ], 401);
    }

    // simpan session (SAMA dengan login asli kamu)
    session([
        'id'    => $admin->id,
        'name'  => $admin->name,
        'level' => $admin->level,
    ]);

    return response()->json([
        'ok' => true
    ]);
});

// Unduh data
Route::post('/admin/export/pendaftar', function () {

    $filename = 'data-pendaftar-' . Carbon::now()->translatedFormat('dmY') .'.csv';

    if (Storage::disk('public')->exists($filename)) {
        Storage::disk('public')->delete($filename);
    }
    Excel::queue(
        new PendaftarExport,
        $filename,
        'public'
    );

    return response()->json([
        'status' => 'processing',
        'filename' => $filename
    ]);
})->middleware('cekAdmin');

Route::get('/admin/export/check/{filename}', function ($filename) {
    if (Storage::disk('public')->exists($filename)) {
        return response()->json([
            'ready' => true,
            'url' => asset('storage/' . $filename)
        ]);
    }

    return response()->json(['ready' => false]);
    // return 'Gagal';

})->middleware('cekAdmin');



