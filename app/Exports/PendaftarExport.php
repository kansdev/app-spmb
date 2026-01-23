<?php

namespace App\Exports;

use App\Models\User;
use App\Services\WilayahService;
use App\Services\AppServices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell, ShouldAutoSize {
    public function collection() {
        return User::with([
            'siswa', 'orang_tua', 'registrasi'
        ])->get();
    }

    public function startCell(): string {
        return 'A5';
    }

    public function headings(): array {
        return [
            'Nama', 
            'Jenis Kelamin', 
            'Agama', 
            'Tanggal Lahir', 
            'Tempat Lahir', 
            'Nomor KK', 
            'NIK', 
            'Akta Lahir', 
            'Disabilitas', 
            'Provinsi', 
            'Kab/Kota', 
            'Kecamatana', 
            'Kelurahan', 
            'Alamat', 
            'Transportasi', 
            'Nama Ayah', 
            'Nama Ibu', 
            'Pekerjaan Ayah', 
            'Pekerjaan Ibu', 
            'Penghasilan Ayah', 
            'Penghasilan Ibu', 
            'Email', 
            'Nomor Telepon', 
            'Nisn', 
            'Asal Sekolah', 
            'Pilihan Pertama', 
            'Pilihan Kedua', 
            'Status Registrasi'            
        ];
    }

    public function map($user): array {
        return [
            // Siswa
            optional($user->siswa)->nama_siswa, 
            optional($user->siswa)->jenis_kelamin, 
            optional($user->siswa)->agama, 
            optional($user->siswa)->tanggal_lahir, 
            optional($user->siswa)->tempat_lahir, 
            optional($user->siswa)->no_kk, 
            optional($user->siswa)->nik, 
            optional($user->siswa)->akta_lahir, 
            optional($user->siswa)->disabilitas, 
            WilayahService::provinsi(optional($user->siswa)->provinsi), 
            WilayahService::kota(optional($user->siswa)->kota), 
            WilayahService::kecamatan(optional($user->siswa)->kecamatan), 
            WilayahService::kelurahan(optional($user->siswa)->kelurahan), 
            optional($user->siswa)->alamat, 
            optional($user->siswa)->transportasi,
            
            // Orang Tua
            optional($user->orang_tua)->nama_ayah, 
            optional($user->orang_tua)->nama_ibu, 
            optional($user->orang_tua)->pekerjaan_ayah, 
            optional($user->orang_tua)->pekerjaan_ibu, 
            AppServices::label(optional($user->orang_tua)->penghasilan_ayah), 
            AppServices::label(optional($user->orang_tua)->penghasilan_ibu), 

            // User
            $user->email,
            $user->nomor_telepon,
            
            // Registrasi
            optional($user->registrasi)->nisn, 
            optional($user->registrasi)->asal_sekolah, 
            optional($user->registrasi)->jurusan_pertama, 
            optional($user->registrasi)->jurusan_kedua,
            optional($user->registrasi)->status, 
            optional($user->registrasi)->alasan_ditolak, 
        ];
    }

    public function styles(Worksheet $sheet) {
        // Judul File
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'DATA PENDAFTAR SMK NUSANTARA 1 KOTA TANGERANG');

        // Tanggal Unduh 
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Tanggal Unduh : '. Carbon::now()->translatedFormat('d F Y'));

        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            2 => [
                'font' => ['italic' => true],
                'alignment' => ['horizontal' => 'center']
            ],
            5 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}