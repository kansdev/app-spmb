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

    {{-- <a href="{{ url('admin/data_pendaftar/unduh') }}" target="_blank" class="btn tbn-sm btn-primary mb-4">
        <i class="menu-icon tf-icons fa-solid fa-download"></i>
        Unduh Data Pendaftar
    </a> --}}

    <button id="btnExport" class="btn btn-md btn-primary mb-4" onclick="exportData()">
        <i class="menu-icon tf-icons fa-solid fa-download"></i>
        Export Data Pendaftar
    </button>

    <button class="btn btn-success btn-md mb-4" data-bs-toggle="modal" data-bs-target="#unduhBuktiPendaftar">
        <i class="menu-icon tf-icons fa-solid fa-download"></i>
        Unduh Bukti daftar
    </button>

    <div class="card">
        <div class="card-header">
            <h5>Data Pendaftar</h5>
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
                                 <s></s>   <td><span class="badge bg-label-warning">{{ $p->status }}</span></td>
                                @elseif($p->status == 'Terverifikasi')
                                    <td><span class="badge bg-label-success">{{ $p->status }}</span></td>
                                @else
                                    <td><span class="badge bg-label-danger">{{ $p->status }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $pendaftar->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        @foreach ($pendaftar as $p)
        <div class="modal fade" id="berkasModal_{{ $p->user_id }}">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Berkas | Nomor Pendaftar : {{$p->nomor_pendaftaran}} | Nama : {{ $p->nama_siswa }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            @foreach ($p->user->upload_berkas as $b)
                                <tr>
                                    <th>File {{ str_replace('_', ' ', $b->type) }}</th>
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

    <div class="modal fade" id="loadingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <h5>Menyiapkan file...</h5>
                <div class="spinner-border mt-3"></div>
                <p class="mt-3 text-muted">
                    Jangan tutup halaman ini
                </p>
            </div>
        </div>
    </div>

    <div id="loadingOverlay"class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-none" style="z-index:9999">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Mohon bersabar, sedang memproses data...</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unduhBuktiPendaftar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Nomor Pendaftar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="nomor_pendaftaran" class="form-label">
                                    Nomor Pendaftaran
                                </label>
                                <input 
                                    type="text" 
                                    id="nomor_pendaftaran" 
                                    class="form-control" 
                                    placeholder="Masukkan nomor pendaftaran"
                                    required
                                >
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button 
                                    type="button" 
                                    id="btnCari"
                                    class="btn btn-primary w-100">
                                    Cari & Unduh
                                </button>
                            </div>
                        </div>

                        <div id="hasilCari" class="mt-4"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <iframe id="downloadFrame" style="display:none;"></iframe>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function exportData() {

            const loading = new bootstrap.Modal(
                document.getElementById('loadingModal')
            );
            loading.show();

            fetch('/admin/export/pendaftar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                checkFile(data.filename, loading);
            });
        }

        function checkFile(filename, loading) {

            const interval = setInterval(() => {
                fetch(`/admin/export/check/${filename}`)
                .then(res => res.json())
                .then(data => {
                    if (data.ready) {
                        clearInterval(interval);
                        loading.hide();

                        // 🚀 AUTO DOWNLOAD
                        window.location.href = data.url;
                    }
                });
            }, 3000); // cek tiap 3 detik
        }
    </script>

    <script>
        document.getElementById('btnCari').addEventListener('click', cariNomorPendaftaran);

        async function cariNomorPendaftaran() {

            let nomorInput = document.getElementById('nomor_pendaftaran');
            let nomor = nomorInput.value.trim();
            let hasil = document.getElementById('hasilCari');

            if (!nomor) {
                alert('Nomor pendaftaran tidak boleh kosong!');
                nomorInput.focus();
                return;
            }

            hasil.innerHTML = `
                <div class="alert alert-info">
                    Mencari data...
                </div>
            `;
            try {

                let response = await fetch(
                    "{{ route('admin.cari_pendaftar') }}?nomor_pendaftaran=" + encodeURIComponent(nomor),
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                );

                if (!response.ok) {
                    let errorData = await response.json();
                    throw errorData;
                }

                let res = await response.json();
                hideLoading();
                if (res.status) {

                    hasil.innerHTML = `
                        <div class="alert alert-success">
                            <strong>Data ditemukan!</strong><br><br>
                            <strong>Nomor Pendaftaran:</strong> ${res.data.nomor_pendaftaran}<br>
                            <strong>Nama:</strong> ${res.data.user?.siswa?.nama_siswa ?? '-'}<br>
                            <strong>Jurusan:</strong> ${res.data.jurusan_pertama ?? '-'}<br><br>
                            Klik tombol di bawah untuk mengunduh bukti pendaftaran.
                        </div> 

                        <a href="javascript:void(0)" data-url="{{ url('/admin/pendaftar') }}/${res.data.id}/unduhBuktiPendaftaran"
                        class="btn btn-primary btn-loading-download">
                            Unduh Bukti Pendaftaran
                        </a>

                        <a href="{{ url('/admin/pendaftar') }}/${res.data.id}/kirim_email"
                        class="btn btn-primary btn-loading">
                            Kirim Email Bukti Pendaftaran
                        </a>
                    `;

                } else {

                    hasil.innerHTML = `
                        <div class="alert alert-danger">
                            ${res.message}
                        </div>
                    `;
                }

            } catch (error) {
                hideLoading();
                if (error.errors) {
                    hasil.innerHTML = `
                        <div class="alert alert-danger">
                            ${Object.values(error.errors)[0][0]}
                        </div>
                    `;
                } else {
                    hasil.innerHTML = `
                        <div class="alert alert-danger">
                            Terjadi kesalahan pada server.
                        </div>
                    `;
                }

                console.error(error);
            }
        }

    </script>  
    
    <script>
        const loadingOverlay = document.getElementById('loadingOverlay');

        function showLoading() {
            loadingOverlay.classList.remove('d-none');
        }

        function hideLoading() {
            loadingOverlay.classList.add('d-none');
        }

        document.addEventListener('click', function(e) {
            const target = e.target.closest('.btn-loading');
            if (target) {
                showLoading();

                target.classList.add('disabled');
                target.style.pointerEvents = 'none';
            }
        });

        window.addEventListener('pageshow', function () {
            hideLoading();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const loadingOverlay = document.getElementById('loadingOverlay');
            const iframe = document.getElementById('downloadFrame');

            function showLoading() {
                loadingOverlay.classList.remove('d-none');
            }

            function hideLoading() {
                loadingOverlay.classList.add('d-none');
            }

            document.addEventListener('click', function (e) {

                const btn = e.target.closest('.btn-loading-download');

                if (btn) {

                    showLoading();

                    const url = btn.getAttribute('data-url');

                    iframe.src = url;

                    // Tunggu beberapa detik lalu sembunyikan
                    setTimeout(() => {
                        hideLoading();
                    }, 3000);
                }

            });

        });

    </script>


@endsection
