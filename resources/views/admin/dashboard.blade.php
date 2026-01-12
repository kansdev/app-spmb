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

    <div class="row">
        <div class="col-sm-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/user.png" alt="User" class="rounded" />
                        </div>
                    </div>
                    <p class="mb-1">Akun</p>
                    <h4 id="total-akun" class="card-title mb-3">{{ $users }}</h4>
                    <a href="#" data-bs-target="#data_user" data-bs-toggle="modal"><small>Lihat Data</small></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3">
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
        <div class="col-sm-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/approve.png" alt="Approve" class="rounded" />
                        </div>
                    </div>
                    <p class="mb-1">Data Teregistrasi</p>
                    <h4 class="card-title mb-3">{{ $teregistrasi }}</h4>
                    <a href="#" data-bs-target="#data_siswa_teregistrasi" data-bs-toggle="modal"><small>Lihat Data</small></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Akun --}}
    <div class="modal fade" id="data_user" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Akun</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="dataAkun" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data_user as $du)
                                <tr id="user-row-{{ $du->id }}">
                                    <td>{{ $du->name}}</td>
                                    <td>{{ $du->email}}</td>
                                    <td>{{ $du->phone}}</td>
                                    <td>
                                        @if ($du->sudah_isi_form)
                                            <!-- TOMBOL DENGAN PERINGATAN -->
                                            <button class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusUser{{ $du->id }}">
                                                Hapus Akun
                                            </button>
                                        @else
                                            <!-- LANGSUNG HAPUS -->
                                            {{-- <a href="{{ route('admin.delete_akun', $du->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                                Hapus Akun
                                            </a> --}}
                                            <button class="btn btn-sm btn-danger btn-hapus-akun" data-id="{{ $du->id }}" data-token="{{ csrf_token() }}">Hapus Akun</button>
                                        @endif
                                    </td>
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
                    <table class="table table-striped" id="dataCalonPendaftar">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Form Siswa</th>
                                <th>Form Orang Tua</th>
                                <th>Data Periodik</th>
                                <th>Nilai Raport</th>
                                <th>Upload Berkas</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($cek_user as $ds)
                                <tr>
                                    <td>{{ $ds['name'] }}</td>
                                    <td>{{ $ds['email'] }}</td>
                                    <td>{{ $ds['phone'] }}</td>
                                    <td><span class="badge bg-label-{{ $ds->siswa ? 'success' : 'warning' }} me-1">{{ $ds->siswa ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds->orang_tua ? 'success' : 'warning' }} me-1">{{ $ds->orang_tua ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds->periodik ? 'success' : 'warning' }} me-1">{{ $ds->periodik ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds->nilai_raport ? 'success' : 'warning' }} me-1">{{ $ds->nilai_raport ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                    <td><span class="badge bg-label-{{ $ds->upload ? 'success' : 'warning' }} me-1">{{ $ds->upload ? 'Selesai' : 'Belum Selesai' }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="data_siswa_teregistrasi" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Akun</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="dataRegistrasi">
                        <thead>
                            <tr>
                                <th>No Pendaftar</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Pilihan Pertama</th>
                                <th>Pilihan Kedua</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pendaftar_teregistrasi as $pt)
                                <tr>
                                    <td>{{ $pt->nomor_pendaftaran}}</td>
                                    <td>{{ $pt->nama_siswa}}</td>
                                    <td>{{ $pt->asal_sekolah}}</td>
                                    <td>{{ $pt->jurusan_pertama}}</td>
                                    <td>{{ $pt->jurusan_kedua}}</td>
                                    @if ($pt->status == 'Belum Terverifikasi')
                                        <td><span class="badge bg-label-warning">{{ $pt->status }}</span></td>
                                    @elseif($pt->status == 'Terverifikasi')
                                        <td><span class="badge bg-label-success">{{ $pt->status }}</span></td>
                                    @elseif ($pt->status == 'Ditolak')
                                        <td><span class="badge bg-label-danger">{{ $pt->status }}</span></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($data_user as $du)
        @if ($du->siswa || $du->orang_tua || $du->periodik || $du->upload_berkas->isNotEmpty() || $du->registrasi)
            <div class="modal fade" id="hapusUser{{ $du->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Peringatan!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p>
                                Akun <strong>{{ $du->name }}</strong>
                                <span class="text-danger">sudah mengisi formulir pendaftaran</span>.
                            </p>
                            <p>
                                Jika dihapus, <strong>seluruh data pendaftaran juga akan ikut terhapus</strong>.
                            </p>
                            <p class="text-danger fw-bold">
                                Yakin ingin melanjutkan?
                            </p>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            {{-- <a href="{{ route('admin.delete_akun', $du->id) }}"
                            class="btn btn-danger">
                                Ya, Hapus Akun
                            </a> --}}
                            <button class="btn btn-sm btn-danger btn-hapus-akun" data-id="{{ $du->id }}" data-token="{{ csrf_token() }}">Hapus Akun</button>
                        </div>

                    </div>
                </div>
            </div>

        @endif
    @endforeach

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-hapus-akun')) {
                e.preventDefault();

                if (!confirm('Yakin ingin menghapus akun ini ? ')) return;

                const id = e.target.dataset.id;
                const token = e.target.dataset.token;

                fetch(`/admin/delete/akun/${id}`, {
                    method : 'DELETE', 
                    headers : {
                        'X-CSRF-TOKEN' : token,
                        'Accept' : 'application/json'
                    }
                })
                .then(async res => {
                    const data = await res.json();
                    if (!res.ok) {
                        alert(data.message);
                        return;
                    }
                    // Hapus baris data
                    document.getElementById(`user-row-${id}`).remove();                      

                    // Hapus penghitungan
                    const counter = document.getElementById('total-akun');
                    counter.innerText = parseInt(counter.innerText) - 1;
                })
                .catch(err => {
                    alert(err.message);
                    console.log(err.message);

                });
            }
        });
    </script>
@endsection
