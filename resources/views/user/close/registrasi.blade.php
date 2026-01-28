@extends('layouts.main')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @elseif(session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if ($data_registrasi)
        <div class="card">
            <div class="alert alert-info mt-4 ms-4 me-4">
                Data registrasi sudah tersimpan dan tidak dapat diubah. Tombol request reset registrasi akan muncul jika hasil seleksi registrasi anda di tolak
            </div>
            {{-- <div class="d-flex justify-content-start ms-4">
                <a href="#" class="btn btn-danger btn-md">
                    <i class="fas fa-repeat"></i> Request Reset Registrasi
                </a>
            </div> --}}
            <h5 class="card-header">Data Registrasi</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Nomor Registrasi</th>
                        <td class="fw-bold">{{ $data_registrasi->nomor_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <th>Nama Siswa</th>
                        <td class="fw-bold">{{ $data_registrasi->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td class="fw-bold">{{ $data_registrasi->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td class="fw-bold">{{ $data_registrasi->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td class="fw-bold">{{ $data_registrasi->nisn }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td class="fw-bold">{{ $data_registrasi->nik }}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td class="fw-bold">{{ $data_registrasi->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Pilihan Jurusan Pertama</th>
                        <td class="fw-bold">{{ $data_registrasi->jurusan_pertama }}</td>
                    </tr>
                    <tr>
                        <th>Pilihan Jurusan Kedua</th>
                        <td class="fw-bold">{{ $data_registrasi->jurusan_kedua }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Tes</th>
                        {{-- <td>{{$data_registrasi->waktu_sesi}}</td> --}}
                        <td class="fw-bold">
                            @if ($data_registrasi->gelombang_sesi === "Gelombang I")
                                {{ $data_registrasi->gelombang_sesi }}, 31 Januari - 1 Februari 2026
                            @elseif ($data_registrasi->gelombang_sesi === "Gelombang II")
                                `{{ $data_registrasi->gelombang_sesi }}, 28 - 29 Maret 2026
                            @elseif($data_registrasi->gelombang_sesi === "Gelombang III")
                                `{{ $data_registrasi->gelombang_sesi }}, 2 - 3 Mei 2026
                            @elseif ($data_registrasi->gelombang_sesi === "Gelombang IV")
                                `{{ $data_registrasi->gelombang_sesi }}, 1 - 6 Juli 2026
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Sesi Tes</th>
                        <td class="fw-bold">{{$data_registrasi->waktu_sesi}}</td>
                    </tr>
                    <tr>
                        <th>Status Registrasi</th>
                        @if ($data_registrasi->status == 'Belum Terverifikasi')
                            <td class="fw-bold" style="color: orange">{{ $data_registrasi->status }}</td>
                        @elseif($data_registrasi->status == 'Terverifikasi')
                            <td class="fw-bold" style="color: green">{{ $data_registrasi->status }}</td>
                        @elseif($data_registrasi->status == 'Ditolak')
                            <td class="fw-bold" style="color: red">{{ $data_registrasi->status }}</td>
                        @endif
                    </tr>
                    @if ($data_registrasi->status == 'Ditolak')
                        <tr>
                            <th>Alasan Di Tolak</th>
                            <td class="fw-bold">{{$data_registrasi->alasan_ditolak}}</td>
                        </tr>
                    @endif


                </table>
            </div>
        </div>
    @else

        <div class="alert alert-danger" role="alert">
            Mohon maaf untuk pendafaran sudah di tutup, silahkan daftar pada gelombang sesi berikutnya !!!
        </div>

        <div id="loadingOverlay"
            class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-none"
            style="z-index:9999">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-center">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2">Menyimpan data pendaftaran...</p>
                </div>
            </div>
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jurusan1 = document.getElementById('pilih-jurusan-pertama');
            const jurusan2 = document.getElementById('pilih-jurusan-kedua');

            function updateJurusanKedua() {
                const selected = jurusan1.value;

                Array.from(jurusan2.options).forEach(option => {
                    option.hidden = false;
                    option.disabled = false;

                    if (option.value === selected) {
                        option.hidden = true;
                        option.disabled = true;
                    }
                });

                // kalau jurusan kedua sama dengan jurusan pertama → reset
                if (jurusan2.value === selected) {
                    jurusan2.value = '';
                }
            }

            jurusan1.addEventListener('change', updateJurusanKedua);
        });

        document.querySelector('form').addEventListener('submit', function () {
            const btn = document.getElementById('btnSubmit');
            const text = document.getElementById('btnText');
            const spinner = document.getElementById('btnSpinner');
            document.getElementById('loadingOverlay').classList.remove('d-none');

            btn.disabled = true;
            text.textContent = 'Memproses data...';
            spinner.classList.remove('d-none');
        });

    </script>

@endsection

