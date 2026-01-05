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
                    <td>{{ $data_registrasi->nomor_pendaftaran }}</td>
                </tr>
                <tr>
                    <th>Nama Siswa</th>
                    <td>{{ $data_registrasi->nama_siswa }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $data_registrasi->tempat_lahir }} Km</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $data_registrasi->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>{{ $data_registrasi->nisn }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $data_registrasi->nik }}</td>
                </tr>
                <tr>
                    <th>Asal Sekolah</th>
                    <td>{{ $data_registrasi->asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Pilihan Jurusan Utama</th>
                    <td>{{ $data_registrasi->jurusan_pertama }}</td>
                </tr>
                <tr>
                    <th>Pilihan Jurusan Cadangan</th>
                    <td>{{ $data_registrasi->jurusan_kedua }}</td>
                </tr>
                <tr>
                    <td>Waktu Tes</td>
                    {{-- <td>{{$data_registrasi->waktu_sesi}}</td> --}}
                    <td>
                        @if ($data_registrasi->waktu_sesi === "Sesi I")
                            Gelombang I, 31 Januari - 1 Februari 2026
                        @elseif ($data_registrasi->waktu_sesi === "Sesi II")
                            Gelombang II, 28 - 29 Maret 2026
                        @elseif($data_registrasi->waktu_sesi === "Sesi III")
                            Gelombang III, 2 - 3 Mei 2026
                        @elseif ($data_registrasi->waktu_sesi === "Sesi IV")
                            Gelombang IV, 1 - 6 Juli 2026
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status Registrasi</th>
                    @if ($data_registrasi->status == 'Belum Terverifikasi')
                        <td style="color: red">{{ $data_registrasi->status }}</td>
                    @else
                        <td style="color: green">{{ $data_registrasi->status }}</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    @else
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
                        <input type="number" class="form-control" name="nomor_pendaftaran" id="nomor-pendaftaran" value="<?= rand(111111, 999999) ?>" readonly/>
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
                        <input type="text" class="form-control" name="asal_sekolah" id="asal-sekolah" placeholder="Masukan sekolah asal anda" value="{{ old('asal_sekolah') }}" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="pilihan-jurusan-pertama" class="form-label">Pilihan Jurusan Pertama</label>
                        <select class="form-control" name="jurusan_pertama" id="pilih-jurusan-pertama">
                            <option value="">--- Pilih ---</option>
                            <option value="MP" {{ old('jurusan_pertama') == 'MP' ? 'selected' : '' }}>Manajemen Perkantoran</option>
                            <option value="AK" {{ old('jurusan_pertama') == 'AK' ? 'selected' : '' }}>Akuntansi</option>
                            <option value="AN" {{ old('jurusan_pertama') == 'AN' ? 'selected' : '' }}>Animasi</option>
                            <option value="TJKT" {{ old('jurusan_pertama') == 'TJKT' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomnuikasi</option>
                            <option value="DKV" {{ old('jurusan_pertama') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                            <option value="PPLG" {{ old('jurusan_pertama') == 'PPLG' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim</option>
                            <option value="BP" {{ old('jurusan_pertama') == 'BP' ? 'selected' : '' }}>Broadcasting dan Perfilman</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="pilihan-jurusan-kedua" class="form-label">Pilihan Jurusan Kedua</label>
                        <select class="form-control" name="jurusan_kedua" id="pilih-jurusan-kedua">
                            <option value="">--- Pilih ---</option>
                            <option value="MP" {{ old('jurusan_pertama') == 'MP' ? 'selected' : '' }}>Manajemen Perkantoran</option>
                            <option value="AK" {{ old('jurusan_pertama') == 'AK' ? 'selected' : '' }}>Akuntansi</option>
                            <option value="AN" {{ old('jurusan_pertama') == 'AN' ? 'selected' : '' }}>Animasi</option>
                            <option value="TJKT" {{ old('jurusan_pertama') == 'TJKT' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomnuikasi</option>
                            <option value="DKV" {{ old('jurusan_pertama') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                            <option value="PPLG" {{ old('jurusan_pertama') == 'PPLG' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim</option>
                            <option value="BP" {{ old('jurusan_pertama') == 'BP' ? 'selected' : '' }}>Broadcasting dan Perfilman</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="gelombang-sesi" class="form-label">Pilih Gelombang Sesi</label>
                        <select class="form-control" name="gelombang_sesi" id="gelombang-sesi">
                            <option value="">--- Pilih ---</option>
                            <option value="Gelombang I" {{ old('gelombang_sesi') == 'Gelombang I' ? 'selected' : '' }}>Gelombang I (31 Januari - 1 Februari 2026)</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="wkatu-sesi" class="form-label">Pilih Waktu Sesi Test</label>
                        <select class="form-control" name="waktu_sesi" id="waktu-sesi">
                            <option value="">--- Pilih ---</option>
                            <option value="Sesi I (09:00 s/d 12:00)" {{ old('waktu_sesi') == 'Sesi I (09:00 s/d 12:00)' ? 'selected' : '' }}>Sesi I (09:00 s/d 12:00)</option>
                            <option value="Sesi II (13:00 s/d 15:00)" {{ old('waktu_sesi') == 'Sesi II (13:00 s/d 15:00)' ? 'selected' : '' }}>Sesi II (13:00 s/d 15:00)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md w-100">Daftar Sekarang</button>
                </form>

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
    </script>

@endsection

