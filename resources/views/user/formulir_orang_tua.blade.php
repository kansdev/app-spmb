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
            Data orang tua sudah tersimpan dan tidak dapat diubah.
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

            <a href="{{ route('formulir_periodik') }}" class="btn btn-primary mt-3">
                Lanjut Isi Data Periodik
            </a>
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
                                    placeholder="contoh: Abdullah" />
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ayah" class="form-label">Nomor KTP Ayah (16 Digit angka)</label>
                                <input type="number" class="form-control @error('nomor_ktp_ayah') is-invalid @enderror" name="nomor_ktp_ayah" id="nomor-ktp-ayah" placeholder="Contoh: 3670123456789">
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
                                <input type="number" class="form-control @error('tahun_lahir_ayah') @enderror" name="tahun_lahir_ayah" id="tahun-lahir" placeholder="Contoh: 1970">
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
                                    <option value="1">1.000.000 s/d 1.500.000</option>
                                    <option value="2">1.500.000 s/d 2.000.000</option>
                                    <option value="3">2.000.000 s/d 2.500.000</option>
                                    <option value="4">2.500.000 s/d 3.000.000</option>
                                    <option value="5">3.000.000 s/d 3.500.000</option>
                                    <option value="6">Lebih dari 3.500.000</option>
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
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
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
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" id="nama-ibu"
                                    placeholder="contoh: SIti Nurbayah" />
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor-ktp-ibu" class="form-label">Nomor KTP Ibu (16 Digit angka)</label>
                                <input type="number" class="form-control @error('nomor_ktp_ibu') is-invalid @enderror" name="nomor_ktp_ibu" id="nomor-ktp-ibu" placeholder="Contoh: 3670123456789">
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
                                <input type="number" class="form-control @error('tahun_lahir_ibu') @enderror" name="tahun_lahir_ibu" id="tahun-lahir" placeholder="Contoh: 1970">
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
                                </select>
                                @error('status_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan-ibu" class="form-label">Penghasilan Ibu</label>
                                <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" name="penghasilan_ibu" id="penghasilan-ibu">
                                    <option value="1">1.000.000 s/d 1.500.000</option>
                                    <option value="2">1.500.000 s/d 2.000.000</option>
                                    <option value="3">2.000.000 s/d 2.500.000</option>
                                    <option value="4">2.500.000 s/d 3.000.000</option>
                                    <option value="5">3.000.000 s/d 3.500.000</option>
                                    <option value="6">Lebih dari 3.500.000</option>
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
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
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
                            placeholder="contoh: Siti Nurbaya" />
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
                        <input type="number" class="form-control" name="tahun_lahir_wali" id="tahun-lahir" placeholder="Contoh: 1970">
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
                            <option value="">-- Pilih Penghasilan --</option>
                            <option value="1">1.000.000 s/d 1.500.000</option>
                            <option value="2">1.500.000 s/d 2.000.000</option>
                            <option value="3">2.000.000 s/d 2.500.000</option>
                            <option value="4">2.500.000 s/d 3.000.000</option>
                            <option value="5">3.000.000 s/d 3.500.000</option>
                            <option value="6">Lebih dari 3.500.000</option>
                            <option value="7">Tidak Berpenghasilan</option>
                        </select>
                    </div>
                    {{-- Disabilitas --}}
                    <div class="form-group mb-3">
                        <label for="disabilitas" class="form-label">Disabilitas</label>
                        <select class="form-control" name="disabilitas_wali" id="disabilitas">
                            <option value="">-- Pilih Disabilitas --</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                </form>

            </div>

        </div>
    @endif

@endsection
