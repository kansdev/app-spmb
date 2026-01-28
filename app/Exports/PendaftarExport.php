<?php

namespace App\Exports;

use App\Models\User;
use App\Services\WilayahService;
use App\Services\AppServices;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class PendaftarExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithCustomStartCell, ShouldAutoSize, ShouldQueue {
    // public function query() {
    //     Log::info('PendaftarExport query executed');
    //     return User::query()->with('siswa');
    // }

    public function query()
    {
        return User::query()->with(['registrasi']);
    }

    public function chunkSize(): int {
        return 500;
    }


    public function startCell(): string {
        return 'A5';
    }

    public function headings(): array {
        return [
            'Nama',
            'Nisn',
            'Asal Sekolah',
            'Pilihan Pertama',
            'Pilihan Kedua',
            'Status Registrasi'
        ];
    }

    public function map($user): array {
        return [
            optional($user->registrasi)->nama_siswa,
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
        $sheet->setCellValue('A1', 'DATA PENDAFTAR PESERTA DIDIK SMK NUSANTARA 1 KOTA TANGERANG');

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
