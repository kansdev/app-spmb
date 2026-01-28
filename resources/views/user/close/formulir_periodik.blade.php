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

    @if ($data_periodik)
        <div class="card">
            <div class="alert alert-info mt-4 ms-4 me-4">
                @if (is_null($cek_user_registrasi))
                    Data periodik masih bisa diubah, jika sudah registrasi data tidak bisa di ubah.
                @else
                    Data periodik sudah tersimpan dan tidak dapat diubah.
                @endif
            </div>
            <h5 class="card-header">Data Periodik</h5>
            <div class="card-body">

                <table class="table table-striped">
                    <tr>
                        <th>Tinggi Badan</th>
                        <td>{{ $data_periodik->tinggi_badan }}</td>
                    </tr>
                    <tr>
                        <th>Berat Badan</th>
                        <td>{{ $data_periodik->berat_badan }}</td>
                    </tr>
                    <tr>
                        <th>Jarak Tempuh</th>
                        <td>{{ $data_periodik->jarak_tempuh }} Km</td>
                    </tr>
                    <tr>
                        <th>Waktu Tempuh (Menit)</th>
                        <td>{{ $data_periodik->waktu_tempuh }} Menit</td>
                    </tr>
                    <tr>
                        <th>Jumlah Saudara Kandung</th>
                        <td>{{ $data_periodik->jumlah_saudara_kandung }}</td>
                    </tr>
                </table>

                @if (is_null($cek_user_registrasi))
                    <a href="{{ route('formulir_orang_tua') }}" class="btn btn-primary mt-3">
                        Lanjut Isi Data Orang Tua
                    </a>
                    <a href="#" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#dataPeriodik{{ $data_periodik->id }}">
                        Ubah Data
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Mohon maaf untuk pendafaran sudah di tutup, silahkan daftar pada gelombang sesi berikutnya !!!
        </div>
    @endif

    @if ($data_periodik)
    <div class="modal fade" id="dataPeriodik{{ $data_periodik->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Periodik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit_periodik', $data_periodik->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <label for="tinggi-badan" class="form-label">Tinggi Badan (Cm)</label>
                            <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" name="tinggi_badan" id="tinggi-badan"
                                placeholder="Satuan dalam sentimeter, contoh: 150" value="{{ $data_periodik->tinggi_badan }}"/>
                            @error('tinggi_badan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="berat-badan" class="form-label">Berat Badan (Kg)</label>
                            <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" name="berat_badan" id="berat-badan"
                                placeholder="Satuan dalam kilogram, contoh: 50" value="{{ $data_periodik->berat_badan }}"/>
                            @error('berat_badan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jarak-tempuh" class="form-label">Jarak Tempuh (Km)</label>
                            <input type="number" class="form-control @error('jarak_tempuh') is-invalid @enderror" name="jarak_tempuh" id="jarak-tempuh"
                                placeholder="Satuan dalam kilometer, contoh: 20" value="{{ $data_periodik->jarak_tempuh }}"/>
                            @error('jarak_tempuh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="waktu-tempuh" class="form-label">Waktu Tempuh (dalam menit)</label>
                            <input type="number" class="form-control @error('waktu_tempuh') is-invalid @enderror" name="waktu_tempuh" id="waktu-tempuh"
                                placeholder="Satuan dalam menit, contoh: 20" value="{{ $data_periodik->waktu_tempuh }}"/>
                            @error('waktu_tempuh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah-saudara-kandung" class="form-label">Jumlah Saudara Kandung</label>
                            <input type="number" class="form-control @error('jumlah_saudara_kandung') is-invalid @enderror" name="jumlah_saudara_kandung" id="jumlah_saudara_kandung" placeholder="Contoh: 3" value="{{ $data_periodik->jumlah_saudara_kandung }}"/>
                            @error('jumlah_saudara_kandung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection
