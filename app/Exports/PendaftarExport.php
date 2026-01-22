<?php

namespace App\Exports;

use App\Models\User;
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
            'Nama', 'Jenis Kelamin', 'Agama', 'Tanggal Lahir', 'Tempat Lahir', 'Nomor KK', 'NIK', 'Akta Lahir', 'Disabilitas', 'Provinsi', 'Kab/Kota', 'Kecamatana', 'Kelurahan', 'Alamat', 'Transportasi', 'Nama Ayah', 'Nama Ibu', 'Pekerjaan Ayah', 'Pekerjaan Ibu', 'Penghasilan Ayah', 'Penghasilan Ibu', 'Email', 'Nisn', 'Asal Sekolah', 'Pilihan Pertama', 'Pilihan Kedua', 'Status Registrasi'
        ];
    }

    public function map($user): array {
        return [
            $user->name, $user->email, optional($user->siswa)->nisn, optional($user->siswa)->asal_sekolah, optional($user->siswa)->status, 
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