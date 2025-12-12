@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-4 col-md-12 col-4 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/user.png" alt="User" class="rounded" />
                        </div>
                    </div>
                    <p class="mb-1">Akun</p>
                    <h4 class="card-title mb-3">{{ $users }}</h4>
                    <a href="#" data-bs-target="#data_user" data-bs-toggle="modal"><small>Lihat Data</small></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/user.png" alt="User" class="rounded" />
                        </div>
                    </div>
                    <p class="mb-1">Calon Pendaftar</p>
                    <h4 class="card-title mb-3">{{ $calon_pendaftar }}</h4>
                    <a href="#" data-bs-target="#data_siswa" data-bs-toggle="modal"><small>Lihat Data</small></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/approve.png" alt="Approve" class="rounded" />
                        </div>
                    </div>
                    <p class="mb-1">Data Teregistrasi</p>
                    <h4 class="card-title mb-3">{{ $teregistrasi }}</h4>
                    <a href="#"><small>Lihat Data</small></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Akun --}}
    <div class="modal fade" id="data_user" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Akun</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data_user as $du)
                                <tr>
                                    <td>{{ $du->name}}</td>
                                    <td>{{ $du->email}}</td>
                                    <td>{{ $du->phone}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="data_siswa" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Akun</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor Telepon</th>
                                <th>Status Form Siswa</th>
                                <th>Status Form Orang Tua</th>
                                <th>Status Form Periodik</th>
                                <th>Status Form Raport</th>
                                <th>Status Form Berkas</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($cek_user as $ds)
                                <tr>
                                    <td>{{ $ds['nama']}}</td>
                                    <td>{{ $ds['phone']}}</td>
                                    <td><span class="badge bg-label-{{ $ds['form_siswa'] ? 'success' : 'warning' }} me-1">{{ $ds['form_orang_tua'] ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds['form_orang_tua'] ? 'success' : 'warning' }} me-1">{{ $ds['form_orang_tua'] ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds['form_periodik'] ? 'success' : 'warning' }} me-1">{{ $ds['form_periodik'] ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds['nilai_raport'] ? 'success' : 'warning' }} me-1">{{ $ds['nilai_raport'] ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds['upload_berkas'] ? 'success' : 'warning' }} me-1">{{ $ds['upload_berkas'] ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
