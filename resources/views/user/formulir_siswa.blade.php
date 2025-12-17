@extends('layouts.main')

@section('content')
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <h5 class="card-header">Formulir Siswa</h5>
        <div class="card-body">
            <form action="{{ route('save_siswa') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama-siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" id="nama-siswa"
                        placeholder="contoh: Alif" value="{{ old('nama_siswa') }}"/>
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                </div>
                <div class="form-group mb-3">
                    <label for="nama-siswa" class="form-label">Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis-kelamin">
                        <option value="">---- Pilih ----</option>
                        <option value="Laki - Laki" {{ old('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- NISN --}}
                <div class="form-group mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn"
                        placeholder="contoh: 0012300123" value="{{ old('nisn') }}" />
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- NIK & KK --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no-kk" class="form-label">Nomor KK</label>
                            <input type="num" class="form-control @error('no_kk') is-invalid @enderror" name="no_kk" id="no-kk" placeholder="Masukan 16 digit angka nomor KK" value="{{ old('no_kk') }}" />
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="num" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="Masukan 16 digit angka NIK" value="{{ old('nik') }}" />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Tempat Lahir --}}
                <div class="form-group mb-3">
                    <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat-lahir"
                        placeholder="contoh: Tangerang" value="{{ old('tempat_lahir') }}" />
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Tanggal Lahir --}}
                <div class="form-group mb-3">
                    <label for="tanggal-lahir" class="form-label">Tanggal lahir</label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal-lahir"
                        placeholder="dd/mm/yyyy" />
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- No Akta --}}
                <div class="form-group mb-3">
                    <label for="akta-lahir" class="form-label">Akta Kelahiran</label>
                    <input type="text" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta-lahir" value="{{ old('akta_lahir') }}" placeholder="Contoh : 3578-LU-28112012-0018 atau 2075/K/2004">
                    @error('akta_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Disabilitas --}}
                <div class="form-group mb-3">
                    <label for="disabilitas" class="form-label">Disabilitas</label>
                    <select class="form-control @error('disabilitas') is-invalid @enderror" name="disabilitas" id="disabilitas">
                        <option value="">--- Pilih ---</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                    @error('disabilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kwarganegaran --}}
                <div class="form-group mb-3">
                    <label for="kwarganegaraan" class="form-label">Kwarganegaraan</label>
                    <select class="form-control @error('kwarganegaraan') is-invalid @enderror" name="kwarganegaraan" id="kwarganegaraan">
                        <option value="">--- Pilih ---</option>
                        <option value="wni">WNI (Warga Negara Indonesia)</option>
                        <option value="wna">WNA (Warga Negara Asing)</option>
                    </select>
                    @error('kwarganegaraan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- @livewire('wilayah-indonesia') --}}
                <div class="row mb-3">
                    <!-- Provinsi -->
                    <div class="col-md-3">
                        <label class="form-label">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi"></select>
                    </div>

                    <!-- Kota -->
                    <div class="col-md-3">
                        <label class="form-label">Kota / Kabupaten</label>
                        <select class="form-control" id="kota" name="kota"></select>
                    </div>

                    <!-- Kecamatan -->
                    <div class="col-md-3">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-control" id="kecamatan" name="kecamatan"></select>
                    </div>

                    <!-- Kelurahan -->
                    <div class="col-md-3">
                        <label class="form-label">Kelurahan</label>
                        <select class="form-control" id="kelurahan" name="kelurahan"></select>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="5"
                        placeholder="contoh: JL. Nusantara 1 No. 12 RT 002 RW 004"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tempat Tinggal --}}
                <div class="form-group mb-3">
                    <label for="tempat-tinggal" class="form-label">Tempat Tinggal</label>
                    <select class="form-control @error('tempat_tinggal') is-invalid @enderror" name="tempat_tinggal" id="tempat-tinggal">
                        <option value="">--- Pilih ---</option>
                        <option value="Rumah Sendiri">Rumah Sendiri</option>
                        <option value="Kontrakan">Kontrakan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('tempat_tinggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Moda Transportasi --}}
                <div class="form-group mb-3">
                    <label for="transportasi" class="form-label">Transportasi</label>
                    <select class="form-control @error('transportasi') is-invalid @enderror" name="transportasi" id="transportasi">
                        <option value="Mobil Pribadi">Mobil Pribadi</option>
                        <option value="Motor">Motor</option>
                        <option value="Angkutan Umum">Angkutan Umum</option>
                        <option value="Jalan Kaki">Jalan Kaki</option>
                    </select>
                    @error('transportasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Anak Keberapa --}}
                <div class="form-group mb-3">
                    <label for="anak-keberapa" class="form-label">Anak Keberapa</label>
                    <input type="num" class="form-control @error('anak_keberapa') is-invalid @enderror" name="anak_keberapa" id="anak-keberapa" placeholder="Contoh: 1" value="{{ old('anak_keberapa') }}">
                    @error('anak_keberapa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-md btn-primary w-100">Simpan</button>
                </div>
            </form>

        </div>

    </div>
@endsection
