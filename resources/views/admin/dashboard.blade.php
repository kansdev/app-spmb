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
                    <a href="javascript:void(0)" id="btn-open-data-user" data-bs-target="#data_user" data-bs-toggle="modal"><small>Lihat Data</small></a>
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
                    <h4 id="total-calon-pendaftar" class="card-title mb-3">{{ $calon_pendaftar }}</h4>
                    <a href="javascript:void(0)" data-bs-target="#data_siswa" data-bs-toggle="modal"><small>Lihat Data</small></a>
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
                    <h4 id="total-pendaftar" class="card-title mb-3">{{ $teregistrasi }}</h4>
                    <a href="javascript(0)" data-bs-target="#data_siswa_teregistrasi" data-bs-toggle="modal"><small>Lihat Data</small></a>
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
                        <tbody id="data-user-body" class="table-border-bottom-0">
                            {{-- @foreach ($data_user as $du)
                                <tr id="user-row-{{ $du->id }}">
                                    <td>{{ $du->name}}</td>
                                    <td>{{ $du->email}}</td>
                                    <td>{{ $du->phone}}</td>
                                    <td>
                                        @if (
                                            $du->siswa_exists ||
                                            $du->orang_tua_exists ||
                                            $du->periodik_exists ||
                                            $du->nilai_raport_exists ||
                                            $du->upload_exists ||
                                            $du->registrasi_exists
                                        )
                                            <button class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusUser{{ $du->id }}">
                                                Hapus Akun
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-danger btn-hapus-akun" data-id="{{ $du->id }}" data-token="{{ csrf_token() }}">Hapus Akun</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                            <tr>
                                <td colspan="4" class="text-center text-muted">Memuat Data....</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div id="pagination-info" class="text-muted small">
                            Memuat informasi...
                        </div>
                        <div id="pagination-user"></div>
                    </div>
                    <div class="mt-3 text-center" id="pagination-user"></div>
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
                                <th>Nama Siswa</th>
                                <th>Form Siswa</th>
                                <th>Form Orang Tua</th>
                                <th>Data Periodik</th>
                                <th>Nilai Raport</th>
                                <th>Upload Berkas</th>
                            </tr>
                        </thead>
                        <tbody id="data-pendaftar-body" class="table-border-bottom-0">

                            <tr>
                                <td colspan="9" id="calon-data" class="text-center text-muted">Memuat Data....</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div id="calon-info" class="text-muted small">
                            Memuat informasi...
                        </div>
                        <div id="calon-user"></div>
                    </div>
                    <div class="mt-3 text-center" id="pagination-user"></div>
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
                        <tbody id="data-pendaftar-teregistrasi" class="table-border-bottom-0">                         <tr>
                                <td colspan="8" id="data-pendaftar-teregistrasi" class="text-center text-muted">Memuat Data....</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div id="pendaftar-info" class="text-muted small">
                            Memuat informasi...
                        </div>
                        <div id="pendaftar"></div>
                    </div>
                    <div class="mt-3 text-center" id="pagination-pendaftar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Akun ini memiliki data terkait. Tetap hapus?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" id="btnConfirmDelete">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="hapusUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Peringatan!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Akun <strong id="hapus-user-nama"></strong><span class="text-danger">sudah mengisi formulir pendaftaran</span>.</p>
                    <p>Jika dihapus, <strong>seluruh data pendaftaran juga akan ikut terhapus</strong>.</p>
                    <p class="text-danger fw-bold">Yakin ingin melanjutkan?</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-sm btn-danger btn-hapus-akun" id="btnConfirmDelete">Hapus Akun</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        let lastTrigger = null;

        document.getElementById('btn-open-data-user').addEventListener('click', function () {
            lastTrigger = this;
        });

        document.getElementById('data_user').addEventListener('hidden.bs.modal', function () {
            lastTrigger?.focus();
        });

    </script>

    <script>
        let dataCalonLoaded = false;

        document.getElementById('data_siswa').addEventListener('shown.bs.modal', function () {
            if (dataCalonLoaded) return;
            loadDataCalon(1); // PAGE DIDEFINISIKAN
            dataCalonLoaded = true;
        });  

        function loadDataCalon(page = 1) {            
            fetch(`/admin/dashboard/data-calon-pendaftar?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(async res => {
                if(!res.status === 401) {
                    const err = await res.json();
                    window.location.href = `/login?error=${encodeURIComponent(err.message)}`;
                    return;
                }
                
                if (!res.ok) {
                    const err = await res.json();
                    throw new Error(err.message);
                }
    
                return res.json();
            })
            .then(res => {
                if (!res.data) {
                    throw new Error('Response tidak valid, ada yang salah dengan pengambilan data !');
                }

                const tbody = document.getElementById('data-pendaftar-body');
                tbody.innerHTML = '';

                if (res.data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center text-muted">Data Kosong</td>
                        </tr>
                    `;
                    document.getElementById('calon-info').innerHTML = 'Tidak ada data';
                    document.getElementById('calon-user').innerHTML = '';
                    return;
                }

                res.data.forEach(u => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${u.name}</td>
                            <td>${u.email}</td>
                            <td>${u.phone ?? '-'}</td>
                            <td>${u.siswa ? u.siswa.nama_siswa : '-'}</td>
                            <td><span class="badge bg-label-${u.siswa_count > 0 ? 'success' : 'warning'}">${u.siswa_count > 0 ? 'Selesai' : 'Belum'}</span></td>
                            <td><span class="badge bg-label-${u.orang_tua_count > 0 ? 'success' : 'warning'}">${u.orang_tua_count > 0 ? 'Selesai' : 'Belum'}</span></td>
                            <td><span class="badge bg-label-${u.periodik_count > 0 ? 'success' : 'warning'}">${u.periodik_count > 0 ? 'Selesai' : 'Belum'}</span></td>
                            <td><span class="badge bg-label-${u.nilai_raport_count > 0 ? 'success' : 'warning'}">${u.nilai_raport_count > 0 ? 'Selesai' : 'Belum'}</span></td>
                            <td><span class="badge bg-label-${u.upload_count > 0 ? 'success' : 'warning'}">${u.upload_count > 0 ? 'Selesai' : 'Belum'}</span></td>
                        </tr>
                    `;
                });

                renderCalonPagination(res, page);
            })
            .catch(err => {
                alert(err);
            });
        }

        function renderCalonPagination(res, currentPage) {
            let html = '';

            for (let i = 1; i <= res.last_page; i++) {
                html += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-light'}"
                        onclick="loadCalonUser(${i})">
                        ${i}
                    </button>
                `;
            }

            console.log(res);
            document.getElementById('calon-user').innerHTML = html;

            const info = `
                Menampilkan <strong>${res.from}</strong>-<strong>${res.to}</strong> dari <strong>${res.total}</strong> data
            `;

            document.getElementById('calon-info').innerHTML = info;
        }
    </script>

    <script>
        let dataPendaftarLoaded = false;

        document.getElementById('data_siswa_teregistrasi').addEventListener('shown.bs.modal', function () {
            if (dataPendaftarLoaded) return;
            loadDataPendaftar(1);
            dataPendaftarLoaded = true;
        });

        function renderStatusBadge(status) {
            switch (status) {
                case 'Belum Terverifikasi':
                    return `<td><span class="badge bg-label-warning">${status}</span></td>`;
                    break;
                case 'Terverifikasi':
                    return `<td><span class="badge bg-label-success">${status}</span></td>`;
                    break;
                case 'Ditolak':
                    return `<td><span class="badge bg-label-danger">${status}</span></td>`;
                    break;
                default:
                    return `<span class="badge bg-label-secondary">${status ?? '-'}</span>`;
            }
        }

        function loadDataPendaftar(page = 1) {
            fetch(`admin/dashboard/data-teregistrasi?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(async res => {
                if(!res.status === 401) {
                    const err = await res.json();
                    window.location.href = `/login?error=${encodeURIComponent(err.message)}`;
                    return;
                }

                if (!res.ok) {
                    const err = await res.json();
                    throw new Error(err.message);
                }
    
                return res.json();
            })
            .then(async res => {
                if (!res.data) {
                    const err = await res.json();
                    throw new Error(err.message ?? 'Respons tidak valid');
                }
    
                const tbody = document.getElementById('data-pendaftar-teregistrasi');
                tbody.innerHTML = '';
    
                if (res.data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center text-muted">Data Kosong</td>
                        </tr>
                    `;
    
                    document.getElementById('pendaftar-info').innerHTML = 'Tidak ada data';
                    document.getElementById('pendaftar').innerHTML = '';
                    return;
                }
    
                res.data.forEach(p => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${p.nomor_pendaftaran}</td>  
                            <td>${p.nama_siswa}</td>  
                            <td>${p.asal_sekolah}</td>  
                            <td>${p.jurusan_pertama}</td>  
                            <td>${p.jurusan_kedua}</td>  
                            <td>${renderStatusBadge(p.status)}</td>                      
                        </tr>
                    `;
                });
    
                renderTeregistrasiPagination(res, page);
            })
            .catch(err => {
                alert(err);
                window.location.href = `/login?error=${encodeURIComponent(err.message)}`;
            });
        }

        function renderTeregistrasiPagination() {
            let html = '';

            for (let i = 1; i <= res.last_page; i++) {
                html += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-light'}"
                        onclick="loadDataPendaftar(${i})">
                        ${i}
                    </button>
                `;
            }

            console.log(res);
            document.getElementById('pendaftar').innerHTML = html;

            const info = `
                Menampilkan <strong>${res.from}</strong>-<strong>${res.to}</strong> dari <strong>${res.total}</strong> data
            `;

            document.getElementById('pendaftar-info').innerHTML = info;
        }
    </script>

    <script>
        let dataUserLoaded = false;

        document.getElementById('data_user').addEventListener('shown.bs.modal', function () {
            if (dataUserLoaded) return;
            loadDataUser(1); // PAGE DIDEFINISIKAN
            dataUserLoaded = true;
        });        

        function loadDataUser(page = 1) {            
            fetch(`/admin/dashboard/data-user?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(async res => {
                if (!res.ok) {
                    const err = await res.json();
                    window.location.href = `/login?error=${encodeURIComponent(err.message)}`;
                    return;
                }

                return res.json();
            })
            .then(res => {
                if (!res.data) {
                    throw new Error('Response tidak valid');
                }

                const tbody = document.getElementById('data-user-body');
                tbody.innerHTML = '';

                if (res.data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">Data Kosong</td>
                        </tr>
                    `;
                    document.getElementById('pagination-info').innerHTML = 'Tidak ada data';
                    document.getElementById('pagination-user').innerHTML = '';
                    return;
                }

                res.data.forEach(user => {
                    tbody.innerHTML += `
                        <tr id="user-row-${user.id}">
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.phone ?? '-'}</td>
                            <td>
                                <a href="#hapusUser${user.id}" class="btn btn-sm btn-danger btn-show-delete" data-id="${user.id}" data-name="${user.name}">Hapus Akun</a>
                            </td>
                        </tr>
                    `;
                });

                renderPagination(res, page);
            })
            .catch(err => {
                alert(err);
            });
        }

        function renderPagination(res, currentPage) {
            let html = '';

            for (let i = 1; i <= res.last_page; i++) {
                html += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-light'}"
                        onclick="loadDataUser(${i})">
                        ${i}
                    </button>
                `;
            }

            console.log(res);
            document.getElementById('pagination-user').innerHTML = html;

            const info = `
                Menampilkan <strong>${res.from}</strong> <strong>${res.to}</strong>dari <strong>${res.total}</strong> data
            `;

            document.getElementById('pagination-info').innerHTML = info;
        }

        let deleteUserId = null;

        document.addEventListener('click', function (e) {
            const btn = e.target.closest(".btn-show-delete");
            if(!btn) return;

            deleteUserId = btn.dataset.id;

            document.getElementById('hapus-user-nama').innerText = btn.dataset.name;

            const modalEl = document.getElementById('hapusUser');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();           
        });

        document.addEventListener('click', function(e) {
            if (e.target.id !== 'btnConfirmDelete') return;

            if (!deleteUserId) return;

            fetch(`/admin/delete/akun/${deleteUserId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept':'application/json'
                },
                credentials: 'same-origin'
            })
            .then(async res => {
                const data = await res.json();
                if(!res.ok) throw new Error(data.message);
                return data;
            })
            .then(() => {
                document.getElementById(`user-row-${deleteUserId}`)?.remove();
                bootstrap.Modal.getInstance(document.getElementById('hapusUser')).hide();
                refreshStatistik()
            })
            .catch(err => alert(err.message));
        });

        function refreshStatistik() {
            fetch('/admin/dashboard/statistik', {
                cache: 'no-store'
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('total-akun').innerText = data.akun;
                document.getElementById('total-calon-pendaftar').innerText = data.calon;
                document.getElementById('total-pendaftar').innerText = data.calon;
            });
        }
    </script>

@endsection
