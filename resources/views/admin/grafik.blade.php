@extends('layouts.main')

@section('content')

    <div class="row">
        @foreach ($statistik as $kecamatan => $items )
            <div class="col-lg-4 col-md-12 col-4 mb-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title">
                            <h5 class="mb-2">Statistik Daerah</h5>
                            <h4 class="card-subtitle fw-bold kecamatan-name" data-id="{{ $kecamatan }}">Kecamatan {{ $kecamatan }} </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex flex-column gap-1">
                                <h3 class="mb-1"> {{ $items->count() }} </h3>
                                <small>Total Kelurahan</small>
                            </div>
                            <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                        @foreach ($items as $kel )
                            <li class="d-flex align-items-center mb-5">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="icon-base bx bx-mobile-alt"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0 kelurahan-name" data-id="{{ $kel->kelurahan }}">{{ $kel->kelurahan }}</h6>
                                        <small>Total Pendaftar</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0">{{ $kel->total }} Siswa</h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


<script>

    async function getNamaKecamatanById(kota) {
        try {
            kota = kota.toString().trim();
            let kotaId = kota.toString().substring(0, 4);
            let response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`);
            let data = await response.json();
            let kec = data.find(item => item.id == kota);
            return kec ? kec.name : kota;
        } catch (error) {
            return kota;
        }
    }

    async function getNamaKelurahanById(kecamatanId) {
        try {
            kecamatannId = kecamatanId.toString().trim();
            let kecId = kecamatanId.toString().substring(0, 7);
            let response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`);
            let data = await response.json();
            let kel = data.find(item => item.id == kecamatanId);
            return kel ? kel.name : kecamatanId;
        } catch (error) {
            return kecamatanId;
        }
    }

    document.addEventListener("DOMContentLoaded", async function () {
        let elements = document.querySelectorAll('.kelurahan-name');

        for (let el of elements) {
            let id = el.getAttribute("data-id");
            let namaKel = await getNamaKelurahanById(id);
            el.textContent = namaKel; // ubah teks
        }
    });

    document.addEventListener("DOMContentLoaded", async function () {
        let elements = document.querySelectorAll('.kecamatan-name');

        for (let el of elements) {
            let id = el.getAttribute("data-id");
            let namaKec = await getNamaKecamatanById(id);
            el.textContent = namaKec; // ubah teks
        }
    });
</script>

@endsection
