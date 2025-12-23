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

    <h3 align="center">Bukti Pendaftara SPMB </h3>

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
            <td width="35%">Jurusan Utama</td>
            <td>: {{ $registrasi->jurusan_pertama }}</td>
        </tr>
        <tr>
            <td width="35%">Jurusan Cadangan</td>
            <td>: {{ $registrasi->jurusan_kedua }}</td>
        </tr>

    </table>
    <br>

    <p>Registrasi Anda telah berhasil pendaftaran kamu berhasil!</p>

    <p>Silahkan datang ke SMK Nusantara 1 Kota Tangerang untuk <strong>Lapor Diri</strong> dengan membawa surat ini.</p>
    <p>Terima kasih sudah mendaftar.</p>

    <p align="right">Tangerang, {{ now()->translatedFormat('d F Y') }} <br> Panitia SPMB</p>
</body>
</html>
