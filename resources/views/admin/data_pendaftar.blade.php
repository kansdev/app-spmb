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
                            <th>Skor Raport</th>
                            <th>Jurusan 1</th>
                            <th>Jurusan 2</th>
                            <th>Berkas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pendaftar as $p)
                            <tr>
                                <td>{{ $p->nomor_pendaftaran}}</td>
                                <td>{{ $p->nama_siswa }}</td>
                                <td>{{ $p->nik }}</td>
                                <td>{{ optional($p->user->nilai_raport)->skor}}</td>
                                <td>{{ $p->jurusan_pertama }}</td>
                                <td>{{ $p->jurusan_kedua }}</td>
                                <td>
                                    <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $p->user_id }}">
                                        Lihat Berkas
                                    </a>
                                </td>
                                @if ($p->status == 'Belum Terverifikasi')
                                    <td><span class="badge bg-label-warning">{{ $p->status }}</span></td>
                                @elseif($p->status == 'Terverifikasi')
                                    <td><span class="badge bg-label-success">{{ $p->status }}</span></td>
                                @else
                                    <td><span class="badge bg-label-danger">{{ $p->status }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($pendaftar as $p)
        <div class="modal fade" id="berkasModal_{{ $p->user_id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Berkas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            @foreach ($berkas as $b)
                                <tr>
                                    <th>{{ str_replace('_', ' ', $b->type) }}</th>
                                    <td>
                                        <div class="d-grid gap-2">
                                            <a href="{{ asset('storage/' . $b->file_path) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm btn-block mt-1">
                                                Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>              
                            @endforeach
                        </table>
                    </div>          
                </div>
            </div>
        </div>  
        @endforeach
        
    </div>

@endsection
