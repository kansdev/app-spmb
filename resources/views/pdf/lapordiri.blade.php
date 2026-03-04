<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifikasi Pendafatarn</title>

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

    <h3 align="center">PENGUMUMAN HASIL SELEKSI <br> SPMB SMK NUSANTARA 1 KOTA TANGERANG 2026-2027</h3>
    
    <br>

    <p>Berdasarkan hasil tes dan penilaian wawancara gelombang 1 yang dilakukan oleh panitia SPMB dan rapat verifikasi hasil seleksi dengan kepala sekolah SMK Nusantara 1 Kota Tangerang</p>

    <h3 align="center">MEMUTUSKAN</h3>

    <p>Bahwa calon peserta didik dengan nama <strong>{{ $nama_siswa }}</strong> dinyatakan <strong>{{ $status }}</strong> sebagai peserta didik baru SMK Nusantara 1 Kota Tangerang Tahun Pelajaran 2026-2027.</p>

    <p>Bagi peserta yang telah lulus, harap perhatikan hal-hal berikut : </p>
    <ol type="1">
        <li>Melakukan lapor diri ke sekolah dengan membawa surat pengumuman hasil seleksi yang telah di cetak</li>
        <li>Melakukan pembukaan rekening tabungan di BMT sebesar Rp. 500.000</li>
        <li>Lapor diri dan pembukaan rekening paling lambat pada tanggal 15 April 2026</li>
        <li>Waktu Operasional Sekolah : Senin - Jum'at, Pukul 08.00 - 15.00.</li>
        <li>Bagi Peserta Reguler (Non PSG) yang mendaftar di Gelombang 1, mendapatkan diskon 25% untuk Biaya Akademik</li>
    </ol>

    <p>Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia. Terima kasih atas kepercayaan Anda memilih SMK Nusantara 1 Kota Tangerang. Kami tunggu kehadiran Anda!</p>

    <p align="right">Tangerang, 5 Februari 2026 <br> Panitia SPMB </p>
    {{-- <div style="clear: both">
        <img style="float: right" src="data:image/png;base64,{{ $qrPng }}" width="150" alt="QR Code">
    </div> --}}
</body>
</html>
