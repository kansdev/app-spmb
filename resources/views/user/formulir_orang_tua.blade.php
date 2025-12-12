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
                            <input type="text" class="form-control" name="nama_ayah" id="nama-ayah"
                                placeholder="contoh: Abdullah" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="status-ayah" class="form-label">Status Ayah</label>
                            <select class="form-control" name="status_ayah" id="status-ayah">
                                <option value="kandung">Kandung</option>
                                <option value="angkat">Angkat</option>
                                <option value="sambung">Sambung</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                            <input type="number" class="form-control" name="tahun_lahir_ayah" id="tahun-lahir" placeholder="Contoh: 1970">
                        </div>
                        <div class="form-group mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan Ayah</label>
                            <select class="form-control" name="pendidikan_ayah" id="pendidikan">
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
                            <select class="form-control" name="pekerjaan_ayah" id="pekerjaan-ayah">
                                <option value="karyawan swasta">Karyawan Swasta</option>
                                <option value="pns-tni-polri">PNS/TNI/POLRI</option>
                                <option value="buruh">Buruh</option>
                                <option value="tidak bekerja">Tidak Bekerja</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penghasilan-ayah" class="form-label">Penghasilan Ayah</label>
                            <select class="form-control" name="penghasilan_ayah" id="penghasilan-ayah">
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
                            <select class="form-control" name="disabilitas_ayah" id="disabilitas">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="divider text-start">
                            <div class="divider-text fs-5 fw-bold">Ibu Kandung</div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama-ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" id="nama-ibu"
                                placeholder="contoh: Siti Nurbaya" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="status-ibu" class="form-label">Status Ibu</label>
                            <select class="form-control" name="status_ibu" id="status-ibu">
                                <option value="kandung">Kandung</option>
                                <option value="angkat">Angkat</option>
                                <option value="sambung">Sambung</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun-lahir" class="form-label">Tahun Lahir</label>
                            <input type="number" class="form-control" name="tahun_lahir_ibu" id="tahun-lahir" placeholder="Contoh: 1970">
                        </div>
                        <div class="form-group mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan Ibu</label>
                            <select class="form-control" name="pendidikan_ibu" id="pendidikan">
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
                            <select class="form-control" name="pekerjaan_ibu" id="pekerjaan-ibu">
                                <option value="karyawan swasta">Karyawan Swasta</option>
                                <option value="pns-tni-polri">PNS/TNI/POLRI</option>
                                <option value="buruh">Buruh</option>
                                <option value="ibu rumah tangga">Ibu Rumah Tangga</option>
                                <option value="tidak bekerja">Tidak Bekerja</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penghasilan-ibu" class="form-label">Penghasilan ibu</label>
                            <select class="form-control" name="penghasilan_ibu" id="penghasilan-ibu">
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
                            <select class="form-control" name="disabilitas_ibu" id="disabilitas">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
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
                        <option>-- Pilih Status Wali --</option>
                        <option value="ayah">Ayah</option>
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
                        <option>-- Pilih Pendidikan --</option>
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
                        <option>-- Pilih Pekerjaan --</option>
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
                        <option>-- Pilih Penghasilan --</option>
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
                        <option>-- Pilih Disabilitas --</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
            </form>

        </div>

    </div>
@endsection
