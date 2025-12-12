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

    <div class="card mb-4">
        <h5 class="card-header fs-2 fw-bold">Registrasi</h5>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger btn-md mb-3">
                    <i class="fas fa-repeat"></i> Request Reset Registrasi
                </button>
            </div>
            <form action="{{ route('save_formulir_registrasi') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="nomor-pendaftaran" class="form-label">No. Pendaftaran</label>
                    <input type="number" class="form-control" name="nomor_pendaftaran" id="nomor-pendaftaran" value="<?= rand(111111, 999999)?>" readonly/>
                </div>

                <div class="form-group mb-3">
                    <label for="nama-siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" id="nama-siswa" value="{{ $data_siswa->nama_siswa }}" readonly/>
                </div>

                <div class="form-group mb-3">
                    <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat-lahir" value="{{ $data_siswa->tempat_lahir }}" readonly/>
                </div>

                {{-- Tanggal Lahir --}}
                <div class="form-group mb-3">
                    <label for="tanggal-lahir" class="form-label">Tanggal lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal-lahir" value="{{ $data_siswa->tanggal_lahir }}" readonly/>
                </div>

                {{-- NISN --}}
                <div class="form-group mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" name="nisn" id="nisn" value="{{ $data_siswa->nisn }}" readonly/>
                </div>

                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="num" class="form-control" name="nik" id="nik" value="{{ $data_siswa->nik }}" readonly/>
                </div>

                <div class="form-group mb-3">
                    <label for="asal-sekolah" class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control" name="asal_sekolah" id="asal-sekolah" />
                </div>

                <div class="form-group mb-3">
                    <label for="pilihan-jurusan-pertama" class="form-label">Pilihan Jurusan Pertama</label>
                    <select class="form-control" name="jurusan_pertama" id="pilih-jurusan-pertama">
                        <option value="MP">Manajemen Perkantoran</option>
                        <option value="AK">Akuntansi</option>
                        <option value="AN">Animasi</option>
                        <option value="TJKT">Teknik Jaringan Komputer dan Telekomnuikasi</option>
                        <option value="DKV">Desain Komunikasi Visual</option>
                        <option value="PPLG">Pengembangan Perangkat Lunak dan Gim</option>
                        <option value="BP">Broadcasting dan Perfilman</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="pilihan-jurusan-kedua" class="form-label">Pilihan Jurusan Kedua</label>
                    <select class="form-control" name="jurusan_kedua" id="pilih-jurusan-kedua">
                        <option value="MP">Manajemen Perkantoran</option>
                        <option value="AK">Akuntansi</option>
                        <option value="AN">Animasi</option>
                        <option value="TJKT">Teknik Jaringan Komputer dan Telekomnuikasi</option>
                        <option value="DKV">Desain Komunikasi Visual</option>
                        <option value="PPLG">Pengembangan Perangkat Lunak dan Gim</option>
                        <option value="BP">Broadcasting dan Perfilman</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-md w-100">Daftar Sekarang</button>
            </form>

        </div>

    </div>
@endsection
