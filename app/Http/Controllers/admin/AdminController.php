<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Mail\NotificationRejectMail;

use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Registrasi;
use App\Models\DocumentUpload;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

use App\Services\AppServices;

class AdminController extends Controller
{
    public function __construct(
        protected AppServices $app
    ) {}

    public function index(): View {
        $admin = session()->only(['id', 'name', 'level']);
        $stats = $this->app->getStatusPendaftar();
        $data_user = $this->app->getDataUser();
        // $data_siswa = $this->app->getDataSiswa();
        // $cek_user = $this->app->getCekUser();
        // $pendaftar_teregistrasi = $this->app->getPendaftarTeregistrasi();

        return view('admin.dashboard', array_merge(
            [
                'admin' => $admin,
                'data_user' => $data_user
            ],
            $stats
        ));
    }

    public function grafik(): View {

        $admin = session()->only(['id', 'name', 'level']);

        $statistik = $this->app->getStatistikWilayah();
        $agama = $this->app->getStatistikAgama();
        $statistik_jurusan = $this->app->getStatistikJurusan();


        return view('admin.grafik', compact('admin', 'statistik', 'agama'), $statistik_jurusan);
    }

    public function pendaftar() {
        $admin = session()->only(['id', 'name', 'level']);

        $calon_pendaftar = $this->app->getCalonPendaftar();
        $jurusan = $this->app->getTotalJurusanPertama();

        return view('admin.pendaftar', compact('admin', 'calon_pendaftar', 'jurusan'));
    }

    public function data_pendaftar() {
        $admin = session()->only(['id', 'name', 'level']);
        $pendaftar = $this->app->getPendaftar();
        return view('admin.data_pendaftar', compact('admin', 'pendaftar'));
    }

    public function data_ditolak() {
        $admin = session()->only(['id', 'name', 'level']);
        $pendaftar = $this->app->getDataDiTolak();
        return view('admin.data_ditolak', compact('admin', 'pendaftar'));
    }

    public function verifikasi($id) {
        $this->app->verifikasi($id);
        return back()->with('success', 'Pendaftar berhasil diverifikasi');
    }

    public function tolak_verifikasi(Request $request, $id) {
        // Cek validasi input alasan
        $request->validate([
            'alasan' => 'required|string'
        ]);

        // Ambil id user untuk email
        $registrasi = Registrasi::with('user')->findOrFail($id);

        // Proses update
        $registrasi->update([
            'status' => 'Ditolak',
            'alasan_ditolak' => $request->alasan
        ]);

        try {
            // Kirim email ke user
            Mail::to($registrasi->user->email)->send(new NotificationRejectMail($registrasi));
        } catch (\Exception $e) {
            // Catat Log eror ketika gagal di kirim
            Log::error('Email registrasi gagal dikirim', [
                'user_id' => optional($registrasi->user)->id,
                'error' => $e->getMessage()
            ]);
        }

        return back()->with('success', 'Pendaftar berhasil ditolak');
    }

    public function delete_akun(Request $request, $id) {
        try {
            $user = User::with([
                'siswa',
                'orang_tua',
                'periodik',
                'nilai_raport',
                'upload_berkas',
                'registrasi'
            ])->findOrFail($id);

            // Cek apakah user sudah mengisi salah satu data
            $sudahMengisi =
                $user->siswa()->exists() ||
                $user->orang_tua()->exists() ||
                $user->periodik()->exists() ||
                $user->nilai_raport()->exists() ||
                $user->upload_berkas()->exists() ||
                $user->registrasi()->exists();

            if ($sudahMengisi) {
                // return back()->with('failed',
                //     'Akun ini sudah mengisi formulir. Penghapusan dapat menyebabkan kehilangan data!'
                // );
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Akun ini sudah mengisi formulir. Penghapusan dapat menyebabkan kehilangan data!'
                ], 422);
            };

            $user->delete();

            Cache::forget('dashboard_stats');

            return response()->json([
                'status' => 'success'
            ], 200);
            // return back()->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Terjadi kesalahan : '. $e->getMessage()
            ], 500);
            // return back()->with('failed', $e->getMessage());
        }
    }
    // Delete berkas
    public function hapus_berkas($id) {
        try {
            $berkas = DocumentUpload::findOrFail($id);

            // Hapus file fisik
            if (Storage::disk('public')->exists($berkas->file_path)) {
                Storage::disk('public')->delete($berkas->file_path);
            }

            // LOG AKTIVITAS
            Log::info('Berkas dihapus', [
                'dihapus_oleh' => Auth::user()->name ?? 'system',
                'role'         => Auth::user()->level ?? 'unknown',
                'user_id'      => $berkas->user_id,
                'berkas_id'    => $berkas->id,
                'jenis_berkas' => $berkas->type,
                'file_path'   => $berkas->file_path,
                'waktu'       => now()->toDateTimeString(),
            ]);


            // Hapus file DB
            $berkas->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berkas Berhasil Di Hapus'
            ]);
        } catch (\Exception $e) {
            return back()->with('failed', 'Gagal menghapus berkas: ' . $e->getMessage());
        }
    }

    public function data_user(Request $request) {
        return response()->json($this->app->getDataUser());
    }

    public function data_calon_pendaftar(Request $request) {
        return response()->json($this->app->getCekUser());
    }

    public function data_teregistrasi(Request $request) {
        return response()->json($this->app->getPendaftarTeregistrasi());
        // return dd($this->app->getPendaftarTeregistrasi());
        // return dd(User::with('registrasi')
        //         ->whereHas('registrasi')
        //         ->paginate(20));
    }

}
