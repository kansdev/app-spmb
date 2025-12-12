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
        <h5 class="card-header fs-2 fw-bold">Formulir Periodik</h5>
        <div class="card-body">
            <form action="{{ route('save_periodik') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="tinggi-badan" class="form-label">Tinggi Badan</label>
                    <input type="number" class="form-control" name="tinggi_badan" id="tinggi-badan"
                        placeholder="Satuan dalam sentimeter, contoh: 150" />
                </div>

                <div class="form-group mb-3">
                    <label for="berat-badan" class="form-label">Berat Badan</label>
                    <input type="number" class="form-control" name="berat_badan" id="berat-badan"
                        placeholder="Satuan dalam kilogram, contoh: 50" />
                </div>

                <div class="form-group mb-3">
                    <label for="jarak-tempuh" class="form-label">Jarak Tempuh</label>
                    <input type="number" class="form-control" name="jarak_tempuh" id="jarak-tempuh"
                        placeholder="Satuan dalam kilometer, contoh: 20" />
                </div>

                <div class="form-group mb-3">
                    <label for="waktu-tempuh" class="form-label">Waktu Tempuh</label>
                    <input type="time" class="form-control" name="waktu_tempuh" id="waktu-tempuh"
                        placeholder="Satuan dalam kilometer, contoh: 20" />
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah-saudara-kandung" class="form-label">Jumlah Saudara Kandung</label>
                    <input type="number" class="form-control" name="jumlah_saudara_kandung" id="jumlah_saudara_kandung" placeholder="Contoh: 3" />
                </div>

                <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
            </form>

        </div>

    </div>
@endsection
