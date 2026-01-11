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
        <div class="card-header pt-2 pb-2">
            <h5>Jumlah Jurusan Yang Sudah Terdaftar</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <tr>
                    @foreach ($jurusan as $j)
                        @if ($j->total > 36)
                            <th style="color: red">{{ $j->jurusan_pertama }} : {{ $j->total }}</th>
                        @else
                            <th>{{ $j->jurusan_pertama }} : {{ $j->total }}</th>
                        @endif
                    @endforeach
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Data Calon Pendaftar</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-border table-striped w-100" id="ak">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Skor Raport</th>
                            <th>Jurusan 1</th>
                            <th>Jurusan 2</th>
                            <th>Berkas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($calon_pendaftar as $cp)
                            <tr>
                                <td>{{ $cp->nomor_pendaftaran}}</td>
                                <td>{{ $cp->nama_siswa }}</td>
                                <td>{{ $cp->nik }}</td>
                                <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                <td>{{ $cp->jurusan_pertama }}</td>
                                <td>{{ $cp->jurusan_kedua }}</td>
                                <td>
                                    <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                        Lihat Berkas
                                    </a>
                                </td>
                                @if ($cp->status == 'Belum Terverifikasi')
                                    <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                @elseif($cp->status == 'Terverifikasi')
                                    <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                @elseif($cp->status == 'Ditolak')
                                    <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

        @foreach ($calon_pendaftar as $cp)
            <div class="modal fade" id="berkasModal_{{ $cp->user_id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Berkas Pendaftar | Nomor Pendaftar : {{$cp->nomor_pendaftaran}} | Nama : {{ $cp->nama_siswa }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <table class="table table-striped">
                                @forelse ($cp->user->upload_berkas as $b)
                                    <tr>
                                        <th>File {{ str_replace('_', ' ', $b->type) }}</th>
                                        <td>
                                            <a href="{{ asset('storage/'.$b->file_path) }}"
                                            target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-danger">
                                            Belum ada berkas
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('admin.ditolak', $cp->id) }}"
                            class="btn btn-danger">
                            Tolak Verifikasi
                            </a>
                            <a href="{{ route('admin.verifikasi', $cp->id) }}"
                            class="btn btn-primary">
                            Verifikasi
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

@endsection
