<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notofikasi Pendafatarn</title>

    <style>
        body {
            font-family: Dejavu Sans;
            font-size: 12px;
        }

        .kop img {
            width: 100%;
        }

        table td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="{{ public_path('assets/img/kop/kop.png') }}">
    </div>

    <br>

    <h3 align="center">Bukti Pendaftaran SPMB </h3>

    <table width="100%">
        <tr>
            <td width="35%">Nama Siswa</td>
            <td>: {{ $registrasi->nama_siswa }}</td>
        </tr>
        <tr>
            <td width="35%">NIK</td>
            <td>: {{ $registrasi->nik }}</td>
        </tr>
        <tr>
            <td width="35%">No Pendaftaran</td>
            <td>: {{ $registrasi->nomor_pendaftaran }}</td>
        </tr>
        <tr>
            <td width="35%">Pilihan Pertama</td>
            <td>: {{ $registrasi->jurusan_pertama }}</td>
        </tr>
        <tr>
            <td width="35%">Pilihan kedua</td>
            <td>: {{ $registrasi->jurusan_kedua }}</td>
        </tr>
        <tr>
            <td width="35%">Waktu Tes</td>
            <td>:
                @if ($registrasi->gelombang_sesi === "Gelombang I")
                    Gelombang I, 31 Januari - 1 Februari 2026, {{ $registrasi->waktu_sesi }}
                @elseif ($registrasi->gelombang_sesi === "Gelombang II")
                    Gelombang II, 28 - 29 Maret 2026, {{ $registrasi->waktu_sesi }}
                @elseif($registrasi->gelombang_sesi === "Gelombang III")
                    Gelombang III, 2 - 3 Mei 2026, {{ $registrasi->waktu_sesi }}
                @elseif ($registrasi->gelombang_sesi === "Gelombang IV")
                    Gelombang IV, 1 - 6 Juli 2026, {{ $registrasi->waktu_sesi }}
                @endif
            </td>
        </tr>

    </table>
    <br>

    <p>Selamat, Registrasi Anda telah berhasil. Selanjutnya silahkan datang ke SMK Nusantara 1 Kota Tangerang untuk <strong>Tes dan Lapor Diri</strong> dengan membawa surat ini sesuai dengan waktu yang telah di pilih. </p>
    <p>Terima kasih sudah mendaftar.</p>

    <p align="right">Tangerang, {{ now()->translatedFormat('d F Y') }} <br> Panitia SPMB </p>
    <div style="clear: both">
        <img style="float: right" src="data:image/png;base64,{{ $qrPng }}" width="150" alt="QR Code">
    </div>
</body>
</html>
