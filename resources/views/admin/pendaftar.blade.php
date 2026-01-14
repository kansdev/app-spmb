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
                <div class="mt-4">
                    {{ $calon_pendaftar->links() }}
                </div>
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
                                    <tr id="berkas-row-{{ $b->id }}">
                                        <th>File {{ str_replace('_', ' ', $b->type) }}</th>
                                        <td class="d-flex gap-2">
                                            <a href="{{ asset('storage/'.$b->file_path) }}"
                                            target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            Lihat
                                            </a>
                                            <button class="btn btn-outline-danger btn-sm btn-hapus-berkas" data-id="{{ $b->id }}" data-token="{{ csrf_token() }}">
                                                Hapus
                                            </button>
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
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal_{{ $cp->id }}">Di Tolak</button>
                            <a href="{{ route('admin.verifikasi', $cp->id) }}"
                            class="btn btn-primary">
                            Verifikasi
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($calon_pendaftar as $cp)
        <div class="modal fade" id="tolakModal_{{ $cp->id }}">
            <div class="modal-dialog">
                <form action="{{ route('admin.ditolak', $cp->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title text-danger">
                                Tolak Pendaftar
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p>
                                Pendaftar:
                                <strong>{{ $cp->nama_siswa }} | {{ $cp->nomor_pendaftaran }} | {{ $cp->nik }} | {{$cp->created_at}}</strong>
                            </p>

                            <div class="mb-3">
                                <label class="form-label">
                                    Alasan Penolakan
                                </label>
                                <textarea name="alasan"
                                        class="form-control"
                                        rows="4"
                                        required
                                        placeholder="Contoh: Berkas tidak lengkap / nilai tidak memenuhi syarat"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-danger">
                                Kirim Penolakan
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        @endforeach


        <script>
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-hapus-berkas')) {
                    e.preventDefault();

                    if (!confirm('Yakin ingin hapus berkas ini ?')) return;

                    const id = e.target.dataset.id;
                    const token = e.target.dataset.token;

                    fetch(`hapus_berkas/${id}`, {
                        method : 'DELETE',
                        headers : {
                            'X-CSRF-TOKEN' : token,
                            'Accept' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.status === 'success') {
                            document.getElementById(`berkas-row-${id}`).remove();
                        }
                    })
                    .catch(err => {
                        alert('Gagal menghapus berkas');
                        console.error(err);
                    });
                }
            })
        </script>

@endsection
