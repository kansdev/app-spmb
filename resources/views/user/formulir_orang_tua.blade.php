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

    @if ($data_orang_tua)
        <div class="card">
            <div class="alert alert-info mt-4 ms-4 me-4">
                @if (is_null($cek_user_registrasi))
                    Data orang tua masih bisa di ubah, jika sudah registrasi data tidak bisa di ubah.
                @else
                    Data orang tua sudah tersimpan dan tidak dapat diubah.
                @endif
            </div>
            <h5 class="card-header">Data Orang Tua</h5>
            <div class="card-body">

                <div class="underline-tabs mb-5">
                    <ul class="nav nav-tabs" id="underlineTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="ayah-tab" data-bs-toggle="tab" data-bs-target="#ayah" type="button" role="tab">Data Ayah</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ibu-tab" data-bs-toggle="tab" data-bs-target="#ibu" type="button" role="tab">Data Ibu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wali-tab" data-bs-toggle="tab" data-bs-target="#wali" type="button" role="tab">Data Wali</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="underlineTabsContent">
                        <div class="tab-pane fade show active" id="ayah" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Ayah</th>
                                    <td>{{ $data_orang_tua->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor KTP Ayah</th>
                                    <td>{{ $data_orang_tua->nomor_ktp_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Status Ayah</th>
                                    <td>{{ $data_orang_tua->status_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Ayah</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Ayah</th>
                                    <td>{{ $data_orang_tua->pendidikan_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah</th>
                                    <td>{{ $data_orang_tua->pekerjaan_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Ayah</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Penghasilan Ayah</th>
                                    @if ($data_orang_tua->penghasilan_ayah == 1)
                                        <td>1.000.000 s/d 1.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 2)
                                        <td>1.500.000 s/d 2.000.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 3)
                                        <td>2.000.000 s/d 2.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 4)
                                        <td>2.500.000 s/d 3.000.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 5)
                                        <td>3.000.000 s/d 3.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 6)
                                        <td>Lebih dari 3.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ayah == 7)
                                        <td>Tidak berpenghasilan</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Disabilitas</th>
                                    @if ($data_orang_tua->disabilitas_ayah == 1)
                                        <td>Ya</td>
                                    @else
                                        <td>Tidak</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="ibu" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Ibu</th>
                                    <td>{{ $data_orang_tua->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor KTP Ibu</th>
                                    <td>{{ $data_orang_tua->nomor_ktp_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Status Ibu</th>
                                    <td>{{ $data_orang_tua->status_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Ibu</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Ibu</th>
                                    <td>{{ $data_orang_tua->pendidikan_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu</th>
                                    <td>{{ $data_orang_tua->pekerjaan_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Ibu</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Penghasilan Ibu</th>
                                    @if ($data_orang_tua->penghasilan_ibu == 1)
                                        <td>1.000.000 s/d 1.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 2)
                                        <td>1.500.000 s/d 2.000.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 3)
                                        <td>2.000.000 s/d 2.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 4)
                                        <td>2.500.000 s/d 3.000.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 5)
                                        <td>3.000.000 s/d 3.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 6)
                                        <td>Lebih dari 3.500.000</td>
                                    @elseif ($data_orang_tua->penghasilan_ibu == 7)
                                        <td>Tidak berpenghasilan</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Disabilitas</th>
                                    @if ($data_orang_tua->disabilitas_ibu == 1)
                                        <td>Ya</td>
                                    @else
                                        <td>Tidak</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="wali" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama wali</th>
                                    <td>{{ $data_orang_tua->nama_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Status Wali</th>
                                    <td>{{ $data_orang_tua->status_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Wali</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Wali</th>
                                    <td>{{ $data_orang_tua->pendidikan_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Wali</th>
                                    <td>{{ $data_orang_tua->pekerjaan_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lahir Wali</th>
                                    <td>{{ $data_orang_tua->tahun_lahir_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Penghasilan Wali</th>
                                    <td>{{ $data_orang_tua->penghasilan_wali }}</td>
                                </tr>
                                <tr>
                                    <th>Disabilitas</th>
                                    <td>{{ optional($data_orang_tua)->disabilitas_wali ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @if (is_null($cek_user_registrasi))
                        <a href="{{ route('formulir_periodik') }}" class="btn btn-primary mt-3">
                            Lanjut Isi Data Periodik
                        </a>
                        <a href="#" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#editOrangTua{{ $data_orang_tua->id }}">
                            Ubah Data Orang Tua
                        </a>
                    @endif

                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <h5 class="card-header fs-2 fw-bold">Formulir Orang Tua</h5>
            <div class="card-body">
                <form action="{{ route('save_orang_tua') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="divider text-start">
                                <div class="divider-text fs-5 fw-bold">Ayah Kandung</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" id="nama-ayah"
                                    placeholder="contoh: Abdullah" value="{{ old('nama_ayah') }}" />
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ayah" class="form-label">Nomor KTP Ayah (16 Digit angka)</label>
                                <input type="number" class="form-control @error('nomor_ktp_ayah') is-invalid @enderror" name="nomor_ktp_ayah" id="nomor-ktp-ayah" placeholder="Contoh: 3670123456789" value="{{ old('nomor_ktp_ayah') }}">
                                @error('nomor_ktp_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status-ayah" class="form-label">Status Ayah</label>
                                <select class="form-control @error('status_ayah') @enderror" name="status_ayah" id="status-ayah">
                                    <option value="">--- Pilih ---</option>
                                    <option value="kandung">Kandung</option>
                                    <option value="angkat">Angkat</option>
                                    <option value="sambung">Sambung</option>
                                </select>
                                @error('status_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control @error('tahun_lahir_ayah') @enderror" name="tahun_lahir_ayah" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ old('tahun_lahir') }}">
                                @error('tahun_lahir_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan Ayah</label>
                                <select class="form-control @error('pendidikan_ayah') is-invalid @enderror" name="pendidikan_ayah" id="pendidikan">
                                    <option value="">--- Pilih ---</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan-ayah" class="form-label">Pekerjaan Ayah</label>
                                <select class="form-control @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" id="pekerjaan-ayah">
                                    <option value="">--- Pilih ---</option>
                                    <option value="karyawan swasta">Karyawan Swasta</option>
                                    <option value="pns-tni-polri">PNS/TNI/POLRI</option>
                                    <option value="buruh">Buruh</option>
                                    <option value="tidak bekerja">Tidak Bekerja</option>
                                    <option value="meninggal">Meninggal</option>
                                </select>
                                @error('status_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-ayah" class="form-label">Penghasilan Ayah</label>
                                <select class="form-control @error('penghasilan_ayah') is-invalid @enderror" name="penghasilan_ayah" id="penghasilan-ayah">
                                    <option value="1">0 s/d 999.999</option>
                                    <option value="2">1.000.000 s/d 2.999.999</option>
                                    <option value="3">2.000.000 s/d 4.999.999</option>
                                    <option value="4">5.000.000 s/d 7.999.999</option>
                                    <option value="5">8.000.000 s/d 9.999.999</option>
                                    <option value="6">Lebih dari 10.000.000</option>
                                    <option value="7">Tidak Berpenghasilan</option>
                                </select>

                                @error('penghasilan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control @error('disabilitas_ayah') is-invalid @enderror" name="disabilitas_ayah" id="disabilitas">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                                @error('penghasilan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="divider text-start">
                                <div class="divider-text fs-5 fw-bold">Ibu Kandung</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" id="nama-ibu" placeholder="contoh: SIti Nurbayah" value="{{ old('nama_ibu') }}" />
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ibu" class="form-label">Nomor KTP Ibu (16 Digit angka)</label>
                                <input type="text" class="form-control @error('nomor_ktp_ibu') is-invalid @enderror" name="nomor_ktp_ibu" id="nomor-ktp-ibu" placeholder="Contoh: 3670123456789" value="{{ old('nomor_ktp_ibu') }}">
                                @error('nomor_ktp_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status-ibu" class="form-label">Status Ibu</label>
                                <select class="form-control @error('status_ibu') @enderror" name="status_ibu" id="status-ibu">
                                    <option value="">--- Pilih ---</option>
                                    <option value="kandung">Kandung</option>
                                    <option value="angkat">Angkat</option>
                                    <option value="sambung">Sambung</option>
                                </select>
                                @error('status_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control @error('tahun_lahir_ibu') @enderror" name="tahun_lahir_ibu" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ old('tahun_lahir_ibu') }}">
                                @error('tahun_lahir_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan Ibu</label>
                                <select class="form-control @error('pendidikan_ibu') is-invalid @enderror" name="pendidikan_ibu" id="pendidikan">
                                    <option value="">--- Pilih ---</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan-ibu" class="form-label">Pekerjaan Ibu</label>
                                <select class="form-control @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" id="pekerjaan-ibu">
                                    <option value="">--- Pilih ---</option>
                                    <option value="karyawan swasta">Karyawan Swasta</option>
                                    <option value="pns-tni-polri">PNS/TNI/POLRI</option>
                                    <option value="buruh">Buruh</option>
                                    <option value="tidak bekerja">Tidak Bekerja</option>
                                    <option value="meninggal">Meninggal</option>
                                </select>
                                @error('status_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-ibu" class="form-label">Penghasilan Ibu</label>
                                <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" name="penghasilan_ibu" id="penghasilan-ibu">
                                    <option value="1">0 s/d 999.999</option>
                                    <option value="2">1.000.000 s/d 2.999.999</option>
                                    <option value="3">2.000.000 s/d 4.999.999</option>
                                    <option value="4">5.000.000 s/d 7.999.999</option>
                                    <option value="5">8.000.000 s/d 9.999.999</option>
                                    <option value="6">Lebih dari 10.000.000</option>
                                    <option value="7">Tidak Berpenghasilan</option>
                                </select>

                                @error('penghasilan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control @error('disabilitas_ibu') is-invalid @enderror" name="disabilitas_ibu" id="disabilitas">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                                @error('penghasilan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="divider text-start">
                        <div class="divider-text fs-5 fw-bold">Wali <span style="font-size: 10px">*Boleh tidak di isi</span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama-wali" class="form-label">Nama Wali</label>
                        <input type="text" class="form-control" name="nama_wali" id="nama-wali"
                            placeholder="contoh: Siti Nurbaya" value="{{ old('nama_wali') }}"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status-wali" class="form-label">Status Wali</label>
                        <select class="form-control" name="status_wali" id="status-wali">
                            <option value="">-- Pilih Status Wali --</option>
                            <option value="ibu">Ayah</option>
                            <option value="ibu">Ibu</option>
                            <option value="kakak">Kakak</option>
                            <option value="paman">Paman</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                        <input type="text" class="form-control" name="tahun_lahir_wali" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ old('tahun_lahir_wali') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan Wali</label>
                        <select class="form-control" name="pendidikan_wali" id="pendidikan">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pekerjaan-wali" class="form-label">Pekerjaan Wali</label>
                        <select class="form-control" name="pekerjaan_wali" id="pekerjaan-wali">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="karyawan swasta">Karyawan Swasta</option>
                            <option value="pns-tni-polri">PNS/TNI/POLRI</option>
                            <option value="buruh">Buruh</option>
                            <option value="wali rumah tangga">wali Rumah Tangga</option>
                            <option value="tidak bekerja">Tidak Bekerja</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="penghasilan-wali" class="form-label">Penghasilan Wali</label>
                        <select class="form-control" name="penghasilan_wali" id="penghasilan-wali">
                            <option value="">--- Pilih ---</option>
                            <option value="1">0 s/d 999.999</option>
                            <option value="2">1.000.000 s/d 2.999.999</option>
                            <option value="3">2.000.000 s/d 4.999.999</option>
                            <option value="4">5.000.000 s/d 7.999.999</option>
                            <option value="5">8.000.000 s/d 9.999.999</option>
                            <option value="6">Lebih dari 10.000.000</option>
                            <option value="7">Tidak Berpenghasilan</option>
                        </select>
                    </div>
                    {{-- Disabilitas --}}
                    <div class="form-group mb-3">
                        <label for="disabilitas" class="form-label">Disabilitas</label>
                        <select class="form-control" name="disabilitas_wali" id="disabilitas">
                            <option value="">-- Pilih Disabilitas --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                </form>

            </div>

        </div>
    @endif

    @if ($data_orang_tua)
        <div class="modal fade" id="editOrangTua{{ $data_orang_tua->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Orang Tua</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit_orang_tua', $data_orang_tua->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="divider text-start">
                                <div class="divider-text fs-5 fw-bold">Ayah Kandung</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" id="nama-ayah"
                                    placeholder="contoh: Abdullah" value="{{ $data_orang_tua->nama_ayah }}" />
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ayah" class="form-label">Nomor KTP Ayah (16 Digit angka)</label>
                                <input type="number" class="form-control @error('nomor_ktp_ayah') is-invalid @enderror" name="nomor_ktp_ayah" id="nomor-ktp-ayah" placeholder="Contoh: 3670123456789" value="{{ $data_orang_tua->nomor_ktp_ayah }}">
                                @error('nomor_ktp_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status-ayah" class="form-label">Status Ayah</label>
                                <select class="form-control @error('status_ayah') @enderror" name="status_ayah" id="status-ayah">
                                    <option value="">--- Pilih ---</option>
                                    <option value="kandung" {{ old('status_ayah', $data_orang_tua->status_ayah) == 'kandung' ? 'selected' : '' }}>Kandung</option>
                                    <option value="angkat" {{ old('status_ayah', $data_orang_tua->status_ayah) == 'angkat' ? 'selected' : '' }}>Angkat</option>
                                    <option value="sambung" {{ old('status_ayah', $data_orang_tua->status_ayah) == 'sambung' ? 'selected' : '' }}>Sambung</option>
                                </select>
                                @error('status_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control @error('tahun_lahir_ayah') @enderror" name="tahun_lahir_ayah" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ $data_orang_tua->tahun_lahir_ayah }}">
                                @error('tahun_lahir_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan Ayah</label>
                                <select class="form-control @error('pendidikan_ayah') is-invalid @enderror" name="pendidikan_ayah" id="pendidikan">
                                    <option value="">--- Pilih ---</option>
                                    <option value="SD" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="S1" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan_ayah', $data_orang_tua->pendidikan_ayah) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan-ayah" class="form-label">Pekerjaan Ayah</label>
                                <select class="form-control @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" id="pekerjaan-ayah">
                                    <option value="">--- Pilih ---</option>
                                    <option value="karyawan swasta" {{ old('pekerjaan_ayah', $data_orang_tua->pekerjaan_ayah) == 'karyawan swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                    <option value="pns/tni/polri" {{ old('pekerjaan_ayah', $data_orang_tua->pekerjaan_ayah) == 'pns/tni/polri' ? 'selected' : '' }}>PNS/TNI/POLRI</option>
                                    <option value="buruh" {{ old('pekerjaan_ayah', $data_orang_tua->pekerjaan_ayah) == 'buruh' ? 'selected' : '' }}>Buruh</option>
                                    <option value="tidak bekerja" {{ old('pekerjaan_ayah', $data_orang_tua->pekerjaan_ayah) == 'tidak bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="meninggal" {{ old('pekerjaan_ayah', $data_orang_tua->pekerjaan_ayah) == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                                @error('pekerjaan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-ayah" class="form-label">Penghasilan Ayah</label>
                                <select class="form-control @error('penghasilan_ayah') is-invalid @enderror" name="penghasilan_ayah" id="penghasilan-ayah">
                                    <option value="1" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '1' ? 'selected' : '' }}>0 s/d 999.999</option>
                                    <option value="2" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '2' ? 'selected' : '' }}>1.000.000 s/d 2.999.999</option>
                                    <option value="3" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '3' ? 'selected' : '' }}>2.000.000 s/d 4.999.999</option>
                                    <option value="4" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '4' ? 'selected' : '' }}>5.000.000 s/d 7.999.999</option>
                                    <option value="5" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '5' ? 'selected' : '' }}>8.000.000 s/d 9.999.999</option>
                                    <option value="6" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '6' ? 'selected' : '' }}>Lebih dari 10.000.000</option>
                                    <option value="7" {{ old('penghasilan_ayah', $data_orang_tua->penghasilan_ayah) == '7' ? 'selected' : '' }}>Tidak Berpenghasilan</option>
                                </select>

                                @error('penghasilan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control @error('disabilitas_ayah') is-invalid @enderror" name="disabilitas_ayah" id="disabilitas">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Ya" {{ old('disabilitas_ayah', $data_orang_tua->disabilitas_ayah) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('disabilitas_ayah', $data_orang_tua->disabilitas_ayah) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('penghasilan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="divider text-start">
                                <div class="divider-text fs-5 fw-bold">Ibu Kandung</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" id="nama-ibu"
                                    placeholder="contoh: Abdullah" value="{{ $data_orang_tua->nama_ibu }}" />
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ibu" class="form-label">Nomor KTP Ibu (16 Digit angka)</label>
                                <input type="number" class="form-control @error('nomor_ktp_ibu') is-invalid @enderror" name="nomor_ktp_ibu" id="nomor-ktp-ibu" placeholder="Contoh: 3670123456789" value="{{ $data_orang_tua->nomor_ktp_ibu }}">
                                @error('nomor_ktp_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status-ibu" class="form-label">Status Ibu</label>
                                <select class="form-control @error('status_ibu') @enderror" name="status_ibu" id="status-ibu">
                                    <option value="">--- Pilih ---</option>
                                    <option value="kandung" {{ old('status_ibu', $data_orang_tua->status_ibu) == 'kandung' ? 'selected' : '' }}>Kandung</option>
                                    <option value="angkat" {{ old('status_ibu', $data_orang_tua->status_ibu) == 'angkat' ? 'selected' : '' }}>Angkat</option>
                                    <option value="sambung" {{ old('status_ibu', $data_orang_tua->status_ibu) == 'sambung' ? 'selected' : '' }}>Sambung</option>
                                </select>
                                @error('status_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control @error('tahun_lahir_ibu') @enderror" name="tahun_lahir_ibu" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ $data_orang_tua->tahun_lahir_ibu }}">
                                @error('tahun_lahir_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan Ibu</label>
                                <select class="form-control @error('pendidikan_ibu') is-invalid @enderror" name="pendidikan_ibu" id="pendidikan">
                                    <option value="">--- Pilih ---</option>
                                    <option value="SD" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="S1" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan_ibu', $data_orang_tua->pendidikan_ibu) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan-ibu" class="form-label">Pekerjaan Ibu</label>
                                <select class="form-control @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" id="pekerjaan-ibu">
                                    <option value="">--- Pilih ---</option>
                                    <option value="karyawan swasta" {{ old('pekerjaan_ibu', $data_orang_tua->pekerjaan_ibu) == 'karyawan swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                    <option value="pns/tni/polri" {{ old('pekerjaan_ibu', $data_orang_tua->pekerjaan_ibu) == 'pns/tni/polri' ? 'selected' : '' }}>PNS/TNI/POLRI</option>
                                    <option value="buruh" {{ old('pekerjaan_ibu', $data_orang_tua->pekerjaan_ibu) == 'buruh' ? 'selected' : '' }}>Buruh</option>
                                    <option value="tidak bekerja" {{ old('pekerjaan_ibu', $data_orang_tua->pekerjaan_ibu) == 'tidak bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="meninggal" {{ old('pekerjaan_ibu', $data_orang_tua->pekerjaan_ibu) == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                                @error('pekerjaan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-ibu" class="form-label">Penghasilan Ibu</label>
                                <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" name="penghasilan_ibu" id="penghasilan-ibu">
                                    <option value="">--- Pilih ---</option>
                                    <option value="1" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '1' ? 'selected' : '' }}>0 s/d 999.999</option>
                                    <option value="2" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '2' ? 'selected' : '' }}>1.000.000 s/d 2.999.999</option>
                                    <option value="3" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '3' ? 'selected' : '' }}>2.000.000 s/d 4.999.999</option>
                                    <option value="4" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '4' ? 'selected' : '' }}>5.000.000 s/d 7.999.999</option>
                                    <option value="5" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '5' ? 'selected' : '' }}>8.000.000 s/d 9.999.999</option>
                                    <option value="6" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '6' ? 'selected' : '' }}>Lebih dari 10.000.000</option>
                                    <option value="7" {{ old('penghasilan_ibu', $data_orang_tua->penghasilan_ibu) == '7' ? 'selected' : '' }}>Tidak Berpenghasilan</option>
                                </select>

                                @error('penghasilan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control @error('disabilitas_ibu') is-invalid @enderror" name="disabilitas_ibu" id="disabilitas">
                                    <option value="">--- Pilih ---</option>
                                    <option value="Ya" {{ old('disabilitas_ibu', $data_orang_tua->disabilitas_ibu) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('disabilitas_ibu', $data_orang_tua->disabilitas_ibu) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('penghasilan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="divider text-start">
                                <div class="divider-text fs-5 fw-bold">Wali <span style="font-size: 10px">*Boleh tidak di isi</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama-wali" class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" name="nama_wali" id="nama-wali"
                                    placeholder="contoh: Siti Nurbaya" value="{{ $data_orang_tua->nama_wali }}"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status-wali" class="form-label">Status Wali</label>
                                <select class="form-control" name="status_wali" id="status-wali">
                                    <option value="">-- Pilih Status Wali --</option>
                                    <option value="ibu" {{ old('status_wali', $data_orang_tua->status_wali) == 'ayah' ? 'selected' : '' }}>Ayah</option>
                                    <option value="ibu" {{ old('status_wali', $data_orang_tua->status_wali) == 'ibu' ? 'selected' : '' }}>Ibu</option>
                                    <option value="kakak" {{ old('status_wali', $data_orang_tua->status_wali) == 'kakak' ? 'selected' : '' }}>Kakak</option>
                                    <option value="paman" {{ old('status_wali', $data_orang_tua->status_wali) == 'paman' ? 'selected' : '' }}>Paman</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" name="tahun_lahir_wali" id="tahun-lahir" placeholder="Contoh: 1970" value="{{ $data_orang_tua->tahun_lahir_wali }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan Wali</label>
                                <select class="form-control" name="pendidikan_wali" id="pendidikan">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="SD" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="S1" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan_wali', $data_orang_tua->pendidikan_wali) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan-wali" class="form-label">Pekerjaan Wali</label>
                                <select class="form-control" name="pekerjaan_wali" id="pekerjaan-wali">
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="karyawan swasta" {{ old('pekerjaan_wali', $data_orang_tua->pekerjaan_wali) == 'karyawan swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                    <option value="pns-tni-polri" {{ old('pekerjaan_wali', $data_orang_tua->pekerjaan_wali) == 'pns/tni/polri' ? 'selected' : '' }}>PNS/TNI/POLRI</option>
                                    <option value="buruh" {{ old('pekerjaan_wali', $data_orang_tua->pekerjaan_wali) == 'buruh' ? 'selected' : '' }}>Buruh</option>
                                    <option value="tidak bekerja" {{ old('pekerjaan_wali', $data_orang_tua->pekerjaan_wali) == 'tidak bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-wali" class="form-label">Penghasilan Wali</label>
                                <select class="form-control" name="penghasilan_wali" id="penghasilan-wali">
                                    <option value="">--- Pilih ---</option>
                                    <option value="1" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '1' ? 'selected' : '' }}>0 s/d 999.999</option>
                                    <option value="2" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '2' ? 'selected' : '' }}>1.000.000 s/d 2.999.999</option>
                                    <option value="3" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '3' ? 'selected' : '' }}>2.000.000 s/d 4.999.999</option>
                                    <option value="4" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '4' ? 'selected' : '' }}>5.000.000 s/d 7.999.999</option>
                                    <option value="5" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '5' ? 'selected' : '' }}>8.000.000 s/d 9.999.999</option>
                                    <option value="6" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '6' ? 'selected' : '' }}>Lebih dari 10.000.000</option>
                                    <option value="7" {{ old('penghasilan_wali', $data_orang_tua->penghasilan_wali) == '7' ? 'selected' : '' }}>Tidak Berpenghasilan</option>
                                </select>
                            </div>
                            {{-- Disabilitas --}}
                            <div class="form-group mb-3">
                                <label for="disabilitas" class="form-label">Disabilitas</label>
                                <select class="form-control" name="disabilitas_wali" id="disabilitas">
                                    <option value="">-- Pilih Disabilitas --</option>
                                    <option value="Ya" {{ old('disabilitas_wali', $data_orang_tua->disabilitas_wali) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('disabilitas_wali', $data_orang_tua->disabilitas_wali) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
