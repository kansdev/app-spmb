@extends('layouts.main')

@section('content')

    <div class="nav-align-top nav-tabs-shadow">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-wilayah" aria-controls="navs-top-wilayah" aria-selected="true">
                    <span class="d-none d-sm-inline-flex align-items-center">Wilayah</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-agama" aria-controls="navs-top-agama" aria-selected="false">
                    <span class="d-none d-sm-inline-flex align-items-center">Agama</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-jurusan_pertama" aria-controls="navs-top-jurusan_pertama" aria-selected="false">
                    <span class="d-none d-sm-inline-flex align-items-center">Jurusan Utama</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-jurusan_kedua" aria-controls="navs-top-jurusan_kedua" aria-selected="false">
                    <span class="d-none d-sm-inline-flex align-items-center">Jurusan Cadangan</span>
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-top-wilayah" role="tabpanel">
                <div class="row">
                    @forelse ($statistik as $kecamatan => $items)
                    <div class="col-sm-4 mb-3">
                        <div class="card bg-primary shadow h-100">
                            <div class="card-header d-flex justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-white mb-2 ">Statistik Daerah</h5>
                                    <h4 class="card-subtitle text-white fw-bold kecamatan-name" data-id="{{ $kecamatan }}">{{ $kecamatan }} </h4>
                                </div>
                            </div>
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex flex-column gap-1">
                                        <h3 class="text-white mb-1"> {{ $items->count() }} </h3>
                                        <small>Total Kelurahan</small>
                                    </div>
                                    <div id="orderStatisticsChart"></div>
                                </div>
                                <ul class="p-0 m-0">
                                @forelse ($items as $kel )
                                    <li class="d-flex align-items-center mb-5">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-primary">
                                                <i class="icon-base bx bx-mobile-alt"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="text-white mb-0 kelurahan-name" data-id="{{ $kel->kelurahan }}">{{ $kel->kelurahan }}</h6>
                                                <small>Total Pendaftar</small>
                                            </div>
                                            <div class="user-progress">
                                                <h6 class="text-white mb-0">{{ $kel->total }} Siswa</h6>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    {{-- JIKA KELURAHAN KOSONG --}}
                                    <li class="text-center text-muted py-4">
                                        <i class="bx bx-info-circle fs-3 mb-2"></i>
                                        <div>Belum ada data kelurahan</div>
                                    </li>
                                @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                        {{-- JIKA STATISTIK KOSONG TOTAL --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-white text-center py-5">
                                    <i class="bx bx-bar-chart-alt-2 fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data statistik</h5>
                                    <p class="mb-0 text-muted">Data pendaftar belum tersedia.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade show" id="navs-top-agama" role="tabpanel">
                <div class="row">
                    @forelse ($agama as $a => $items)
                        <div class="col-sm-4 mb-3">
                            <div class="card bg-primary h-100">
                                <div class="card-header  d-flex justify-content-between">
                                    <div class="card-title">
                                        <h5 class=" text-white mb-2">Statistik Agama {{ ucfirst($a) }}</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex flex-column gap-1">
                                            <h3 class=" text-white mb-1">{{ $items }} </h3>
                                            <small class="text-white">Siswa</small>
                                        </div>
                                        <div id="icon">
                                            @if ($a == 'islam')
                                                <img src="/assets/img/icons/religious/islam.png" width="50" alt="" srcset="">
                                            @elseif($a == 'hindu')
                                                <img src="/assets/img/icons/religious/hindu.png" width="50" alt="" srcset="">
                                            @elseif ($a == 'budha')
                                                <img src="/assets/img/icons/religious/budha.png" width="50" alt="" srcset="">
                                            @elseif ($a == 'khonghucu')
                                                <img src="/assets/img/icons/religious/khonghucu.png" width="50" alt="" srcset="">
                                            @else
                                                <img src="/assets/img/icons/religious/kristen.png" width="50" alt="" srcset="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- JIKA STATISTIK KOSONG TOTAL --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="bx bx-bar-chart-alt-2 fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data statistik</h5>
                                    <p class="mb-0 text-muted">Data pendaftar belum tersedia.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade show" id="navs-top-jurusan_pertama" role="tabpanel">

                <div class="row">
                    @forelse ($statistik_jurusan_pertama as $kode => $total)
                        <div class="col-sm-4 mb-3">
                            <div class="card bg-primary h-100">
                                <div class="card-header  d-flex justify-content-between">
                                    <div class="card-title">
                                        <h3 class="text-white mb-2">Statistik Jurusan</h5>
                                        <h5 class="text-white">{{ $map_jurusan[$kode] ?? $kode }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex flex-column gap-1">
                                            <h3 class=" text-white mb-1">{{ $total }} </h3>
                                            <small class="text-white">Siswa</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- JIKA STATISTIK KOSONG TOTAL --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="bx bx-bar-chart-alt-2 fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data statistik</h5>
                                    <p class="mb-0 text-muted">Data jurusan belum tersedia.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="tab-pane fade show" id="navs-top-jurusan_kedua" role="tabpanel">

                <div class="row">
                    @forelse ($statistik_jurusan_kedua as $kode => $total)
                        <div class="col-sm-4 mb-3">
                            <div class="card bg-primary h-100">
                                <div class="card-header  d-flex justify-content-between">
                                    <div class="card-title">
                                        <h3 class="text-white mb-2">Statistik Jurusan</h5>
                                        <h5 class="text-white">{{ $map_jurusan[$kode] ?? $kode }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex flex-column gap-1">
                                            <h3 class=" text-white mb-1">{{ $total }} </h3>
                                            <small class="text-white">Siswa</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- JIKA STATISTIK KOSONG TOTAL --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="bx bx-bar-chart-alt-2 fs-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data statistik</h5>
                                    <p class="mb-0 text-muted">Data jurusan belum tersedia.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
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
