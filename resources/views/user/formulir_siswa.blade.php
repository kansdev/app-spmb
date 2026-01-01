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

    @if ($siswa)
        <div class="card">
            <div class="alert alert-info mt-4 ms-4 me-4">
                @if (is_null($cek_user_registrasi))
                    Data siswa masih bisa diubah, jika sudah registrasi data tidak bisa di ubah.
                @else
                    Data siswa sudah tersimpan dan tidak dapat diubah.
                @endif
            </div>
            <h5 class="card-header">Data Siswa</h5>
            <div class="card-body">

                <table class="table table-striped">
                    <tr>
                        <th>Nama Siswa</th>
                        <td>{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $siswa->nik }}</td>
                    </tr>
                    <tr>
                        <th>No KK</th>
                        <td>{{ $siswa->no_kk }}</td>
                    </tr>
                    <tr>
                        <th>Tempat / Tanggal Lahir</th>
                        <td>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $siswa->alamat }}</td>
                    </tr>
                </table>
                @if (is_null($cek_user_registrasi))
                    <a href="{{ route('formulir_orang_tua') }}" class="btn btn-primary mt-3">
                        Lanjut Isi Data Orang Tua
                    </a>
                    <a href="#" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#modalEditSiswa{{ $siswa->id }}">
                        Ubah Data
                    </a>
                @endif
            </div>
        </div>
    @else
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

                    {{-- Disabilitas --}}
                    <div class="form-group mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama">
                            <option value="">--- Pilih ---</option>
                            <option value="islam {{ old('agama') == 'islam' ? 'selected' : '' }}">Islam</option>
                            <option value="katolik {{ old('agama') == 'katolik' ? 'selected' : '' }}">Katolik</option>
                            <option value="protestan {{ old('agama') == 'protestan' ? 'selected' : '' }}">Protestan</option>
                            <option value="hindu {{ old('agama') == 'hindu' ? 'selected' : '' }}">Hindu</option>
                            <option value="budha {{ old('jenis_kelamin') == 'budha' ? 'selected' : '' }}">Budha</option>
                            <option value="khonghucu {{ old('jenis_kelamin') == 'khonghucu' ? 'selected' : '' }}">KhongHucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            placeholder="dd/mm/yyyy" {{ old('tanggal_lahir')}}/>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- No Akta --}}
                    <div class="form-group mb-3">
                        <label for="akta-lahir" class="form-label">Akta Kelahiran</label>
                        <input type="text" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta-lahir" value="{{ old('akta_lahir') }}" placeholder="Contoh : 3578-LU-28112012-0018 atau 2075/K/2004" {{ old('akta_lahir')}}>
                        @error('akta_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Disabilitas --}}
                    <div class="form-group mb-3">
                        <label for="disabilitas" class="form-label">Disabilitas</label>
                        <select class="form-control @error('disabilitas') is-invalid @enderror" name="disabilitas" id="disabilitas">
                            <option value="">--- Pilih ---</option>
                            <option value="Ya {{ old('disabilitas') == 'Ya' ? 'selected' : '' }}">Ya</option>
                            <option value="Tidak {{ old('disabilitas') == 'Tidak' ? 'selected' : '' }}">Tidak</option>
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
                            <option value="wni {{ old('kwarganegaraan') == 'wni' ? 'selected' : '' }}">WNI (Warga Negara Indonesia)</option>
                            <option value="wna {{ old('kwarganegaraan') == 'wna' ? 'selected' : '' }}">WNA (Warga Negara Asing)</option>
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
                            placeholder="contoh: JL. Nusantara 1 No. 12 RT 002 RW 004">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tempat Tinggal --}}
                    <div class="form-group mb-3">
                        <label for="tempat-tinggal" class="form-label">Tempat Tinggal</label>
                        <select class="form-control @error('tempat_tinggal') is-invalid @enderror" name="tempat_tinggal" id="tempat-tinggal">
                            <option value="">--- Pilih ---</option>
                            <option value="Rumah Sendiri" {{ old('tempat_tinggal') == 'Rumah Sendiri' ? 'selected' : '' }}>Rumah Sendiri</option>
                            <option value="Kontrakan" {{ old('tempat_tinggal') == 'Kontrakan' ? 'selected' : '' }}>Kontrakan</option>
                            <option value="Lainnya" {{ old('tempat_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('tempat_tinggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Moda Transportasi --}}
                    <div class="form-group mb-3">
                        <label for="transportasi" class="form-label">Transportasi</label>
                        <select class="form-control @error('transportasi') is-invalid @enderror" name="transportasi" id="transportasi">
                            <option value="Mobil Pribadi" {{ old('transportasi') == 'Mobil Pribadi' ? 'selected' : '' }}>Mobil Pribadi</option>
                            <option value="Motor" {{ old('transport') == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Angkutan Umum" {{ old('transport') == 'Angkutan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                            <option value="Jalan Kaki" {{ old('transport') == 'Jalan Kaki' ? 'selected' : '' }}>Jalan Kaki</option>
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
    @endif

    @if ($siswa)
        <div class="modal fade" id="modalEditSiswa{{ $siswa->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit_siswa', $siswa->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama-siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" id="nama-siswa"
                                    placeholder="contoh: Alif" value="{{ $siswa->nama_siswa }}"/>
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-siswa" class="form-label">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis-kelamin">
                                    <option value="Laki - Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki - Laki' ? 'selected' : '' }}>
                                        Laki - Laki
                                    </option>

                                    <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- NISN --}}
                            <div class="form-group mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn"
                                    placeholder="contoh: 0012300123" value="{{ $siswa->nisn }}" />
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- NIK & KK --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no-kk" class="form-label">Nomor KK</label>
                                        <input type="num" class="form-control @error('no_kk') is-invalid @enderror" name="no_kk" id="no-kk" placeholder="Masukan 16 digit angka nomor KK" value="{{ $siswa->no_kk }}" />
                                        @error('no_kk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="num" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="Masukan 16 digit angka NIK" value="{{ $siswa->nik }}" />
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama">
                                    <option value="">--- Pilih ---</option>
                                    <option value="islam" {{ old('agama', $siswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="katolik" {{ old('agama', $siswa->agama) == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="protestan" {{ old('agama', $siswa->agama) == 'protestan' ? 'selected' : '' }}>Protestan</option>
                                    <option value="hindu" {{ old('agama', $siswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="budha" {{ old('agama', $siswa->agama) == 'budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="khonghucu" {{ old('agama', $siswa->agama) == 'khonghucu' ? 'selected' : '' }}>KhongHucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tempat Lahir --}}
                            <div class="form-group mb-3">
                                <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat-lahir"
                                    placeholder="contoh: Tangerang" value="{{ $siswa->tempat_lahir }}" />
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Tanggal Lahir --}}
                            <div class="form-group mb-3">
                                <label for="tanggal-lahir" class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal-lahir"
                                    placeholder="dd/mm/yyyy" value="{{ $siswa->tanggal_lahir }}"/>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- No Akta --}}
                            <div class="form-group mb-3">
                                <label for="akta-lahir" class="form-label">Akta Kelahiran</label>
                                <input type="text" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta-lahir" value="{{ $siswa->akta_lahir }}" placeholder="Contoh : 3578-LU-28112012-0018 atau 2075/K/2004">
                                @error('akta_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control @error('disabilitas') is-invalid @enderror" name="disabilitas" id="disabilitas">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Ya" {{ old('disabilitas', $siswa->disabilitas) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('disabilitas', $siswa->disabilitas) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
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
                                    <option value="wni" {{ old('kwarganegaraan', $siswa->kwarganegaraan) == 'wni' ? 'selected' : '' }}>WNI (Warga Negara Indonesia)</option>
                                    <option value="wna" {{ old('kwarganegaraan', $siswa->kwarganegaraan) == 'wna' ? 'selected' : '' }}>WNA (Warga Negara Asing)</option>
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
                                    placeholder="contoh: JL. Nusantara 1 No. 12 RT 002 RW 004">{{ $siswa->alamat }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tempat Tinggal --}}
                            <div class="form-group mb-3">
                                <label for="tempat-tinggal" class="form-label">Tempat Tinggal</label>
                                <select class="form-control @error('tempat_tinggal') is-invalid @enderror" name="tempat_tinggal" id="tempat-tinggal">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Rumah Sendiri" {{ old('tempat_tinggal', $siswa->tempat_tinggal) == 'Rumah Sendiri' ? 'selected' : '' }}>Rumah Sendiri</option>
                                    <option value="Kontrakan" {{ old('tempat_tinggal', $siswa->tempat_tinggal) == 'Kontrakan' ? 'selected' : '' }}>Kontrakan</option>
                                    <option value="Lainnya" {{ old('tempat_tinggal', $siswa->tempat_tinggal) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('tempat_tinggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Moda Transportasi --}}
                            <div class="form-group mb-3">
                                <label for="transportasi" class="form-label">Transportasi</label>
                                <select class="form-control @error('transportasi') is-invalid @enderror" name="transportasi" id="transportasi">
                                    <option value="Mobil Pribadi" {{ old('transportasi') == 'Mobil Pribadi' ? 'selected' : '' }}>Mobil Pribadi</option>
                                    <option value="Motor" {{ old('transport') == 'Motor' ? 'selected' : '' }}>Motor</option>
                                    <option value="Angkutan Umum" {{ old('transport') == 'Angkutan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                                    <option value="Jalan Kaki" {{ old('transport') == 'Jalan Kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                                </select>
                                @error('transportasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Anak Keberapa --}}
                            <div class="form-group mb-3">
                                <label for="anak-keberapa" class="form-label">Anak Keberapa</label>
                                <input type="num" class="form-control @error('anak_keberapa') is-invalid @enderror" name="anak_keberapa" id="anak-keberapa" placeholder="Contoh: 1" value="{{ $siswa->anak_keberapa }}">
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
            </div>
        </div>

    @endif
@endsection
