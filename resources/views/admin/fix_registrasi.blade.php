@extends('layouts.main')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Data jumlah lulusan yang sudah diverifikasi lulus --}}
    <div class="card mb-4 bg-light shadow">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <h5 class="card-title text-danger">Jumlah Pendaftar yang Sudah Diverifikasi Lulus</h5>
                    <p class="card-text">Berikut adalah jumlah pendaftar yang sudah diverifikasi lulus berdasarkan jurusan pilihan pertama:</p>
                    <table class="table table-striped">
                        <tr>
                            @foreach ($pendaftar_terverifikasi as $jurusan => $total)
                                <th>{{ $jurusan }} : {{ $total }} Calon</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Total Pendaftar Diterima : {{ $total_fix_registrasi }} Calon</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0)" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload data</a>
    <a href="#" class="btn btn-primary btn-sm mb-3">Lihat Data Siswa</a>

        <div class="card mb-4">
            <h5 class="card-header fs-2 fw-bold">Formulir Siswa Diterima</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-border table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan Pilihan 1</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pendaftar as $index => $siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $siswa->nomor_pendaftaran ?? "-" }}</td>
                                    <td>{{ $siswa->nama_siswa ?? "-" }}</td>
                                    <td>{{ $siswa->asal_sekolah ?? "-" }}</td>
                                    <td>{{ $siswa->jurusan ?? "-" }}</td>
                                    <td>{{ $siswa->status ?? "-" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $pendaftar->links('pagination::bootstrap-5') }}
                    </div>
                </div>                

            </div>
        </div>

        {{-- <div id="loadingOverlay"
            class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-none"
            style="z-index:9999">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-center">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2">Menyimpan data pendaftaran...</p>
                </div>
            </div>
        </div> --}}

        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Data By Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('fix-registrasi.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Pilih file Excel</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>

                            {{-- <div class="progress mb-3 d-none" id="progressWrapper">
                                <div class="progress-bar" id="progressBar" 
                                    role="progressbar" 
                                    style="width: 0%">0%</div>
                            </div> --}}

                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- <script>
        document.querySelector('form').addEventListener('submit', function () {
            const btn = document.getElementById('btnSubmit');
            const text = document.getElementById('btnText');
            const spinner = document.getElementById('btnSpinner');
            document.getElementById('loadingOverlay').classList.remove('d-none');

            btn.disabled = true;
            text.textContent = 'Memproses data...';
            spinner.classList.remove('d-none');
        });
    </script> --}}

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(this);
            let progressWrapper = document.getElementById('progressWrapper');
            let progressBar = document.getElementById('progressBar');

            progressWrapper.classList.remove('d-none');

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "{{ route('fix-registrasi.upload') }}", true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    let percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + "%";
                    progressBar.innerHTML = percent + "%";
                }
            };

            xhr.onload = function() {

                let response = JSON.parse(xhr.responseText);

                if (response.success) {
                    progressBar.classList.add('bg-success');
                    alert(response.message);
                    location.reload();
                } else {
                    progressBar.classList.add('bg-danger');
                    alert(response.message);
                }
            };

            xhr.send(formData);
        });
</script>

@endsection