<?php

namespace App\Imports;

use App\Models\FixRegistrasi;
use Illuminate\Support\Facades\DB;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    SkipsOnError,
    SkipsErrors,
    SkipsEmptyRows,  
    WithValidation
};

class FixRegistrasiImport implements ToModel, WithHeadingRow, WithChunkReading, /**ShouldQueue,**/ SkipsOnError,  SkipsEmptyRows, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use SkipsErrors;

    public function model(array $row)
    {
        return new FixRegistrasi([
            // 'user_id' => $row['user_id'],
            'nomor_pendaftaran' => $row['nomor_pendaftaran'],
            'nama_siswa' => $row['nama_siswa'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'nisn' => $row['nisn'],
            'nik' => $row['nik'],
            'asal_sekolah' => $row['asal_sekolah'],
            'jurusan' => $row['jurusan'],
            'skor_tes' => $row['skor_tes'],
            'status' => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nomor_pendaftaran' => 'required',
            '*.nama_siswa' => 'required'           
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
