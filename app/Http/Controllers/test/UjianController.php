<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Registrasi;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\SoalAcak;

use Carbon\Carbon;

class UjianController extends Controller
{
    // Cek nomor registrasi
    public function cek_registrasi(Request $request)
    {
        $siswa = Registrasi::where('nomor_pendaftaran', $request->nomor_pendaftaran )->first();

        if(!$siswa) {
            return response()->json([
                'status' => false,
                'message' => 'Nomor registrasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $siswa
        ]);
    }

    public function mulai_ujian($id_siswa)
    {
        $siswa = Registrasi::findOrFail($id_siswa);

        $ujian = Ujian::updateOrCreate(
            ['id_siswa' => $id_siswa],
            [
                'status' => 'mulai',
                'tahap' => 'umum',
                'mulai_at' => now()
            ]
        );

        $soal = SoalAcak::where('id_siswa', $id_siswa)->count();

        if(SoalAcak::where('id_siswa', $id_siswa)->count() == 0) {
            $this->generate_soal($siswa, 'umum');
        }

        // dd($soal);
        return redirect()->route('ujian.soal', $id_siswa);
    }

    public function halaman_soal($id_siswa)
    {
        $siswa = Registrasi::findOrFail($id_siswa);
        $ujian = Ujian::where('id_siswa', $id_siswa)->first();
        $waktu_mulai = $ujian->mulai_at;
        $durasi = 60 * 60; // 60 menit

        $sisa_waktu = max(0, $durasi - now()->diffInSeconds($waktu_mulai));

        // Jika waktu habis, update status ujian dan tampilkan halaman selesai
        if ($sisa_waktu <= 0) {
            $ujian->update([
                'status' => 'selesai',
                'selesai_at' => now()
            ]);
            return view('test.selesai');
        }

        // jalankan cek tahap (umum → jeda)
        $this->cek_tahap($siswa, $ujian);

        // =========================
        // HANDLE JEDA
        // =========================
        if ($ujian->tahap == 'jeda') {

            // kalau belum ada waktu selesai umum → tampil jeda
            if (!$ujian->waktu_selesai_umum) {
                return view('test.jeda');
            }

            $selesai = \Carbon\Carbon::parse($ujian->waktu_selesai_umum);

            if (now()->lt($selesai->copy()->addSeconds(60))) {
                // return view('test.jeda');
                // tampilkan halaman selesai jika sudah mengerjakan semua soal
                $status = $ujian->status;
                if ($ujian->status == 'selesai') {
                    return view('test.selesai');
                }
                return view('test.jeda');
                // return "Jeda 60 detik sebelum lanjut ke kejuruan";
                // dd($status);
            }

            // ✅ lewat 60 detik → lanjut kejuruan

            // generate soal kejuruan kalau belum ada
            if (SoalAcak::where('id_siswa', $id_siswa)->where('tahap', 'kejuruan')->count() == 0) {
                $this->generate_soal($siswa, 'kejuruan');
            }

            // update tahap ke kejuruan
            $ujian->update(['tahap' => 'kejuruan']);

            return redirect()->route('ujian.soal', $id_siswa);
            // return "Sudah masuk ke soal selanjutnya ";
        }

        // Ambil soal berikutnya berdasarkan jumlah jawaban yang sudah ada
        $jumlah_jawab = Jawaban::where('id_siswa', $id_siswa)->where('tahap', $ujian->tahap)->count();

        $soal = SoalAcak::with('soal')->where('id_siswa', $id_siswa)->where('tahap', $ujian->tahap)->orderBy('urutan')->skip($jumlah_jawab)->first();

        // Jika soal habis, cek tahap dan update status
        if (!$soal) {

            // selesai tahap umum → ke jeda
            if ($ujian->tahap == 'umum') {
                return "Jeda 60 detik sebelum lanjut ke kejuruan";
                // return view('test.jeda');
            }

            // selesai tahap kejuruan → selesai ujian
            if ($ujian->tahap == 'kejuruan') {
                $ujian->update([
                    'status' => 'selesai',
                    'selesai_at' => now()
                ]);

                return view('test.selesai');
            }
        }

        // Tampilkan soal
        return view('test.soal', [
            'soal' => $soal,
            'nomor' => $jumlah_jawab + 1,
            'sisa_waktu' => $sisa_waktu
        ]);
    }

    private function cek_tahap($siswa, $ujian)
    {
        if ($ujian->tahap == 'umum') {

            $totalSoal = SoalAcak::where('id_siswa', $siswa->id)
                ->where('tahap', 'umum')
                ->count();

            $jumlahJawab = Jawaban::where('id_siswa', $siswa->id)
                ->where('tahap', 'umum')
                ->count();

            if ($jumlahJawab == $totalSoal && $totalSoal > 0) {

                $ujian->update([
                    'tahap' => 'jeda',
                    'waktu_selesai_umum' => now()
                ]);

                return; // ❗ STOP di sini
            }
        }

        if ($ujian->tahap == 'jeda') {

            // kalau belum ada waktu selesai, jangan lanjut
            if (!$ujian->waktu_selesai_umum) {
                return;
            }

            $selesai = Carbon::parse($ujian->waktu_selesai_umum);

            if (now()->diffInSeconds($selesai) < 60) {
                return; // ❗ masih jeda
            }

            // lanjut ke kejuruan
            $ujian->update(['tahap' => 'kejuruan']);

            // generate soal
            if (SoalAcak::where('id_siswa', $siswa->id)
                ->where('tahap', 'kejuruan')
                ->count() == 0) {

                $this->generate_soal($siswa, 'kejuruan');
            }
        }
    }

    private function generate_soal($siswa, $tahap)
    {
        $kategori = $this->get_kategori_soal($siswa, $tahap);

        $soal = Soal::whereIn('kategori', (array)$kategori)
            ->inRandomOrder()
            ->get();
        foreach ($soal as $index => $s) {
            SoalAcak::create([
                'id_siswa' => $siswa->id,
                'id_soal' => $s->id,
                'urutan' => $index + 1,
                'tahap' => $tahap
            ]);
        }
    }

    private function get_kategori_soal($siswa, $tahap)
    {
        $jurusan = strtoupper($siswa->jurusan_pertama);

        if ($tahap == 'umum') {
            return ['bindo', 'mtk', 'bing'];
        }

        if ($tahap == 'kejuruan') {
            if(in_array($jurusan, ['BP', 'AN', 'DKV'])) {
                return ['kejuruan_bp_an_dkv'];
            }
            if(in_array($jurusan, ['PPLG', 'TJKT'])) {
                return ['kejuruan_pplg_tjkt'];
            }
            if(in_array($jurusan, ['AK'])) {
                return ['kejuruan_ak'];
            }
            if(in_array($jurusan, ['MP'])) {
                return ['kejuruan_mp'];
            }
        }
        return [];
    }

    public function simpan_jawaban(Request $request)
    {

        $ujian = Ujian::where('id_siswa', $request->id_siswa)->first();
        $waktu_mulai = $ujian->mulai_at;
        $durasi = 60 * 60; // 60 menit
        $sisa_waktu = max(0, $durasi - now()->diffInSeconds($waktu_mulai));

        if ($sisa_waktu <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Waktu habis, tidak bisa menyimpan jawaban dari sisa pertanyaan ini'
            ], 400);
        }

        Jawaban::updateOrCreate(
            [
                'id_siswa' => $request->id_siswa,
                'id_soal' => $request->id_soal
            ],
            [
                'kunci_jawaban' => $request->jawaban,
                'urutan' => $request->urutan,
                'tahap' => $request->tahap
            ]
        );

        return response()->json([
            'status' => true
        ]);
        // return view('ujian.simpan');
    }
}
