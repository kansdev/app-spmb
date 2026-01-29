<?php

namespace App\Exports;

use App\Models\User;
use App\Services\WilayahService;
use App\Services\AppServices;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class PendaftarExport implements FromQuery, WithHeadings, WithMapping,  ShouldAutoSize, ShouldQueue, WithEvents {
    public function query() {
        return User::query()->with(['siswa', 'registrasi']);
    }

    public function chunkSize(): int {
        return 500;
    }

    public function startCell(): string {
        return 'A4';
    }

    public function headings(): array {
        return [
            'Nomor Registrasi',
            'Nama',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Nisn',
            'Asal Sekolah',
            'Pilihan Pertama',
            'Pilihan Kedua',
            'Sesi',
            'Waktu Sesi',
            'Status Registrasi'
        ];
    }

    public function map($user): array {
        return [
            optional($user->registrasi)->nomor_pendaftaran,
            optional($user->registrasi)->nama_siswa,
            optional($user->siswa)->agama,
            optional($user->siswa)->tempat_lahir,
            optional($user->siswa)->tanggal_lahir,
            optional($user->siswa)->jenis_kelamin,
            optional($user->registrasi)->nisn,
            optional($user->registrasi)->asal_sekolah,
            optional($user->registrasi)->jurusan_pertama,
            optional($user->registrasi)->jurusan_kedua,
            optional($user->registrasi)->gelombang_sesi,
            optional($user->registrasi)->waktu_sesi,
            optional($user->registrasi)->status,
        ];
    }


    public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Sisipkan 3 baris di atas
                $sheet->insertNewRowBefore(1, 3);

                // ===== JUDUL =====
                $sheet->mergeCells('A1:M1');
                $sheet->setCellValue(
                    'A1',
                    'DATA PENDAFTAR PESERTA DIDIK SMK NUSANTARA 1 KOTA TANGERANG'
                );

                // ===== TANGGAL =====
                $sheet->mergeCells('A2:M2');
                $sheet->setCellValue(
                    'A2',
                    'Tanggal Unduh : ' . Carbon::now()->translatedFormat('d F Y')
                );

                // ===== STYLE JUDUL =====
                $sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'italic' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // ===== STYLE HEADING (BARIS 4) =====
                $sheet->getStyle('A4:M4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
            }
        ];
    }
}
