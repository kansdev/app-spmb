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

<div class="card">
    <div class="card-header">
        <h5>Data Calon Pendaftar</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-border table-striped w-100" id="pendaftar">
                <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Nilai Raport</th>
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
                            <td>{{ optional($cp->user->nilai_raport)->rata_rata}}</td>
                            <td>{{ $cp->jurusan_pertama }}</td>
                            <td>{{ $cp->jurusan_kedua }}</td>
                            <td></td>
                            @if ($cp->status == 'Belum Terverifikasi')
                                <td><a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#verifikasi_{{ $cp->id }}">{{ $cp->status }}</button></td>
                            @elseif($cp->status == 'Terverifikasi')
                                <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                            @else
                                <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($calon_pendaftar as $cp)
        <div class="modal fade" id="verifikasi_{{ $cp->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi verifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin memverfikasi pendaftar ini ?
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</a>
                        <a href="{{ route('admin.ditolak', $cp->id) }}" class="btn btn-danger btn-md">Tolak Verifikasi</a>
                        <a href="{{ route('admin.verifikasi', $cp->id) }}" class="btn btn-primary btn-md">Verifikasi</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
