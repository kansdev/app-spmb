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

    @if ($nilai_raport)
        <div class="card">
            <div class="alert alert-info mt-4 ms-4 me-4">
                @if (is_null($cek_user_registrasi))
                    Nilai raport masih bisa diubah, jika sudah registrasi data tidak bisa di ubah.
                @else
                    Nilai rapor sudah tersimpan dan tidak dapat diubah.
                @endif
            </div>
            <h5 class="card-header">Data Nilai Raport</h5>
            <div class="card-body">

                <div class="nav-align-top nav-tabs-shadow">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-bahasa-indonesia" aria-controls="navs-top-bahasa-indonesia" aria-selected="true">
                                <span class="d-none d-sm-inline-flex align-items-center">Bahasa Indonesia</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-matematika" aria-controls="navs-top-matematika" aria-selected="false">
                                <span class="d-none d-sm-inline-flex align-items-center">Matematika</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-bahasa-inggris" aria-controls="navs-top-bahasa-inggris" aria-selected="false">
                                <span class="d-none d-sm-inline-flex align-items-center">Bahasa Inggris</span>
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-top-bahasa-indonesia" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Skor Bahasa Indonesia Semester 1</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_indonesia_1 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Indonesia Semester 2</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_indonesia_2 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Indonesia Semester 3</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_indonesia_3 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Indonesia Semester 4</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_indonesia_4 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Indonesia Semester 5</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_indonesia_5 }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-matematika" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Skor Matematika Semester 1</th>
                                    <td>{{ $nilai_raport->nilai_matematika_1 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Matematika Semester 2</th>
                                    <td>{{ $nilai_raport->nilai_matematika_2 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Matematika Semester 3</th>
                                    <td>{{ $nilai_raport->nilai_matematika_3 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Matematika Semester 4</th>
                                    <td>{{ $nilai_raport->nilai_matematika_4 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Matematika Semester 5</th>
                                    <td>{{ $nilai_raport->nilai_matematika_5 }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-bahasa-inggris" role="tabpanel">
                            <table class="table table-striped">
                                <tr>
                                    <th>Skor Bahasa Inggris Semester 1</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_inggris_1 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Inggris Semester 2</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_inggris_2 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Inggris Semester 3</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_inggris_3 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Inggris Semester 4</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_inggris_4 }}</td>
                                </tr>
                                <tr>
                                    <th>Skor Bahasa Inggris Semester 5</th>
                                    <td>{{ $nilai_raport->nilai_bahasa_inggris_5 }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="alert alert-danger mt-4">
                    Total skor keseluruhan mata pelajaran : <strong> {{ optional($nilai_raport)->skor }} </strong>
                </div>

                @if (is_null($cek_user_registrasi))
                    <a href="{{ route('upload_berkas') }}" class="btn btn-primary mt-3">
                        Lanjut Upload Berkas
                    </a>
                    <a href="#" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#editNilaiRaport{{ $nilai_raport->id }}">
                        Ubah Data Raport
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Mohon maaf untuk pendafaran sudah di tutup, silahkan daftar pada gelombang sesi berikutnya !!!
        </div>
    @endif

    @if ($nilai_raport)
        <div class="modal fade" id="editNilaiRaport{{ $nilai_raport->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai Raport</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit_nilai_raport', $nilai_raport->id) }}" method="post">
                            @csrf
                            @method('put')
                            {{-- Nilai Semester 1 --}}
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="divider text-start">
                                        <div class="divider-text fs-5 fw-bold">Nilai Raport Semester 1</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-indonesia-1" class="form-label">Nilai Bahasa Indonesia</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_indonesia_1') is-invalid @enderror" name="nilai_bahasa_indonesia_1" id="nilai-bahasa_indonesia-1"
                                            placeholder="Isikan Nilai bahasa indonesia semester 1" value="{{ $nilai_raport->nilai_bahasa_indonesia_1 }}" />
                                        @error('nilai_bahasa_indonesia_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-matematika-1" class="form-label">Nilai Matematika</label>
                                        <input type="text" class="form-control @error('nilai_matematika_1') is-invalid @enderror" name="nilai_matematika_1" id="nilai-matematika-1"
                                            placeholder="Isikan Nilai matematika semester 1" value="{{ $nilai_raport->nilai_matematika_1 }}"/>
                                        @error('nilai_matematika_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-inggris-1" class="form-label">Nilai Bahasa Inggris</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_inggris_1') is-invalid @enderror" name="nilai_bahasa_inggris_1" id="nilai-bahasa_inggris-1"
                                            placeholder="Isikan Nilai bahasa inggris semester 1" value="{{ $nilai_raport->nilai_bahasa_inggris_1 }}" />
                                        @error('nilai_bahasa_inggris_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Nilai Semester 2 --}}
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="divider text-start">
                                        <div class="divider-text fs-5 fw-bold">Nilai Raport Semester 2</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-indonesia-2" class="form-label">Nilai Bahasa Indonesia</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_indonesia_2') is-invalid @enderror" name="nilai_bahasa_indonesia_2" id="nilai-bahasa_indonesia-2"
                                            placeholder="Isikan Nilai bahasa indonesia semester 2" value="{{ $nilai_raport->nilai_bahasa_indonesia_2 }}" />
                                        @error('nilai_bahasa_indonesia_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-matematika-2" class="form-label">Nilai Matematika</label>
                                        <input type="text" class="form-control @error('nilai_matematika_2') is-invalid @enderror" name="nilai_matematika_2" id="nilai-matematika-2"
                                            placeholder="Isikan Nilai matematika semester 2" value="{{ $nilai_raport->nilai_matematika_2 }}"/>
                                        @error('nilai_matematika_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-inggris-2" class="form-label">Nilai Bahasa Inggris</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_inggris_2') is-invalid @enderror" name="nilai_bahasa_inggris_2" id="nilai-bahasa_inggris-2"
                                            placeholder="Isikan Nilai bahasa inggris semester 2" value="{{ $nilai_raport->nilai_bahasa_inggris_2 }}" />
                                        @error('nilai_bahasa_inggris_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Nilai Semester 3 --}}
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="divider text-start">
                                        <div class="divider-text fs-5 fw-bold">Nilai Raport Semester 3</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-indonesia-3" class="form-label">Nilai Bahasa Indonesia</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_indonesia_3') is-invalid @enderror" name="nilai_bahasa_indonesia_3" id="nilai-bahasa_indonesia-3"
                                            placeholder="Isikan Nilai bahasa indonesia semester 3" value="{{ $nilai_raport->nilai_bahasa_indonesia_3 }}" />
                                        @error('nilai_bahasa_indonesia_3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-matematika-3" class="form-label">Nilai Matematika</label>
                                        <input type="text" class="form-control @error('nilai_matematika_3') is-invalid @enderror" name="nilai_matematika_3" id="nilai-matematika-3"
                                            placeholder="Isikan Nilai matematika semester 3" value="{{ $nilai_raport->nilai_matematika_3 }}"/>
                                        @error('nilai_matematika_3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-inggris-3" class="form-label">Nilai Bahasa Inggris</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_inggris_3') is-invalid @enderror" name="nilai_bahasa_inggris_3" id="nilai-bahasa_inggris-3"
                                            placeholder="Isikan Nilai bahasa inggris semester 3" value="{{ $nilai_raport->nilai_bahasa_inggris_3 }}" />
                                        @error('nilai_bahasa_inggris_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Nilai Semester 4 --}}
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="divider text-start">
                                        <div class="divider-text fs-5 fw-bold">Nilai Raport Semester 4</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-indonesia-4" class="form-label">Nilai Bahasa Indonesia</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_indonesia_4') is-invalid @enderror" name="nilai_bahasa_indonesia_4" id="nilai-bahasa_indonesia-4"
                                            placeholder="Isikan Nilai bahasa indonesia semester 4" value="{{ $nilai_raport->nilai_bahasa_indonesia_4 }}" />
                                        @error('nilai_bahasa_indonesia_4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-matematika-4" class="form-label">Nilai Matematika</label>
                                        <input type="text" class="form-control @error('nilai_matematika_4') is-invalid @enderror" name="nilai_matematika_4" id="nilai-matematika-4"
                                            placeholder="Isikan Nilai matematika semester 4" value="{{ $nilai_raport->nilai_matematika_4 }}"/>
                                        @error('nilai_matematika_4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-inggris-4" class="form-label">Nilai Bahasa Inggris</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_inggris_4') is-invalid @enderror" name="nilai_bahasa_inggris_4" id="nilai-bahasa_inggris-4"
                                            placeholder="Isikan Nilai bahasa inggris semester 4" value="{{ $nilai_raport->nilai_bahasa_inggris_4 }}" />
                                        @error('nilai_bahasa_inggris_4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Nilai Semester 5 --}}
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="divider text-start">
                                        <div class="divider-text fs-5 fw-bold">Nilai Raport Semester 5</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-indonesia-5" class="form-label">Nilai Bahasa Indonesia</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_indonesia_5') is-invalid @enderror" name="nilai_bahasa_indonesia_5" id="nilai-bahasa_indonesia-5"
                                            placeholder="Isikan Nilai bahasa indonesia semester 5" value="{{ $nilai_raport->nilai_bahasa_indonesia_5 }}" />
                                        @error('nilai_bahasa_indonesia_5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-matematika-5" class="form-label">Nilai Matematika</label>
                                        <input type="text" class="form-control @error('nilai_matematika_5') is-invalid @enderror" name="nilai_matematika_5" id="nilai-matematika-5"
                                            placeholder="Isikan Nilai matematika semester 5" value="{{ $nilai_raport->nilai_matematika_5 }}"/>
                                        @error('nilai_matematika_5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai-bahasa-inggris-5" class="form-label">Nilai Bahasa Inggris</label>
                                        <input type="text" class="form-control @error('nilai_bahasa_inggris_5') is-invalid @enderror" name="nilai_bahasa_inggris_5" id="nilai-bahasa_inggris-5"
                                            placeholder="Isikan Nilai bahasa inggris semester 5" value="{{ $nilai_raport->nilai_bahasa_inggris_5 }}" />
                                        @error('nilai_bahasa_inggris_5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
