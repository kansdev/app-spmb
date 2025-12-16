@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Data Calon Pendaftar</h5>
    </div>
    <div class="card-body">
        <table class="table table-border table-striped" id="pendaftar">
            <thead>
                <tr>
                    <th>No Pendaftaran</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Nilai Raport</th>
                    <th>Jurusan 1</th>
                    <th>Jurusan 2</th>
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
                        @if ($cp->status == 'Belum Terverifikasi')
                            <td><button type="button" class="btn btn-sm btn-danger">{{ $cp->status }}</button></td>
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

@endsection
