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

    <div id="notif"></div>
    
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambahSoalModal">Tambah Soal</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Soal</button>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5>Soal Tes Masuk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-border table-striped w-100" id="pendaftar">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Soal</th>
                            <th>Kunci Jawaban</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($soal_test as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strToUpper($s->kategori) }}</td>
                                <td>{{ $s->pertanyaan }}</td>
                                <td>{{ $s->kunci_jawaban }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahSoalModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formSoal">
                        @csrf
                        <div class="mb-3">
                            <label for="soal" class="form-label">Soal</label>
                            <textarea class="form-control" id="soal" name="soal" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="mtk">Matematika</option>
                                <option value="bindo">Bahasa Indonesia</option>
                                <option value="bing">Bahasa Inggris</option>
                                <option value="kejuruan_mp">Kejuruan MP</option>
                                <option value="kejuruan_ak">Kejuruan AK</option>
                                <option value="kejuruan_bp_an_dkv">Kejuruan BP/AN/DKV</option>
                                <option value="kejuruan_pplg_tjkt">Kejuruan PPLG/TJKT</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_a" class="form-label">Jawaban A</label>
                            <input type="text" class="form-control" id="jawaban_a" name="jawaban_a" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_b" class="form-label">Jawaban B</label>
                            <input type="text" class="form-control" id="jawaban_b" name="jawaban_b" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_c" class="form-label">Jawaban C</label>
                            <input type="text" class="form-control" id="jawaban_c" name="jawaban_c" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_d" class="form-label">Jawaban D</label>
                            <input type="text" class="form-control" id="jawaban_d" name="jawaban_d" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_e" class="form-label">Jawaban E</label>
                            <input type="text" class="form-control" id="jawaban_e" name="jawaban_e" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                            <select class="form-control" id="jawaban_benar" name="kunci_jawaban" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file_soal" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file_soal" name="file_soal" accept=".xlsx, .xls" required>
                        </div>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formSoal').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = document.getElementById('formSoal');
            let formData = new FormData(form);

            fetch('/admin/soal_test/save', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.status) {
                    document.getElementById('notif').innerHTML = `<div class="alert alert-success">${res.message}</div>`;
                    location.reload();
                    form.reset();
                    
                } else {
                    document.getElementById('notif').innerHTML =
                        `<div class="alert alert-danger">${res.message}</div>`;
                }
            });
        });
    </script>

@endsection
