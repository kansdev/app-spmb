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

        $this->cek_tahap($siswa, $ujian);

        $jumlah_jawab = Jawaban::where('id_siswa', $id_siswa)->where('tahap', $ujian->tahap)->count();
        $soal = SoalAcak::with('soal')->where('id_siswa', $id_siswa)->where('tahap', $ujian->tahap)->orderBy('urutan')->skip($jumlah_jawab)->first();
        
        if(!$soal) {
            if($ujian->tahap == 'umum') {
                return view('test.jeda');
            }

            if($ujian->tahap == 'jeda') {
                // Generate soal kejuruan                
                $this->generate_soal($siswa, 'kejuruan');
                $ujian->update(['tahap' => 'kejuruan']);
                return redirect()->route('ujian.soal', $id_siswa);
            }

            $ujian->update(['status' => 'selesai', 'selesai_at' => now()]);
            return view('test.selesai');
        }

        return view('test.soal', ['soal' => $soal, 'nomor' => $jumlah_jawab + 1]); 
    }

    private function cek_tahap($siswa, $ujian)
    {
        // dari umum → jeda
        if ($ujian->tahap == 'umum') {
            $totalSoal = SoalAcak::where('id_siswa', $siswa->id)
                ->where('tahap', 'umum')
                ->count();

            $jumlahJawab = Jawaban::where('id_siswa', $siswa->id)
                ->where('tahap', 'umum')
                ->count();

            if ($jumlahJawab >= $totalSoal && $totalSoal > 0) {
                $ujian->update([
                    'tahap' => 'jeda',
                    'waktu_selesai_umum' => now()
                ]);
            }
        }

        // dari jeda → kejuruan
        if ($ujian->tahap == 'jeda') {
            $selesai = Carbon::parse($ujian->waktu_selesai_umum);

            if (now()->diffInSeconds($selesai) >= 60) {
                $kategori = $this->get_kategori_soal($siswa, 'kejuruan');

                $cekSoal = Soal::whereIn('kategori', (array)$kategori)->count();

                if ($cekSoal == 0) {
                    return "Soal kejuruan untuk jurusan " . $siswa->jurusan_pertama . " belum tersedia. Silakan hubungi panitia."; 
                }

                $ujian->update(['tahap' => 'kejuruan']);

                // generate soal kejuruan
                if (SoalAcak::where('id_siswa', $siswa->id)
                    ->where('tahap', 'kejuruan')
                    ->count() == 0) {
                    $this->generate_soal($siswa, 'kejuruan');
                }
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
