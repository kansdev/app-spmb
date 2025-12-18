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
                Nilai rapor sudah tersimpan dan tidak dapat diubah.
            </div>
            <h5 class="card-header">Data Nilai Raport</h5>
            <div class="card-body">

                <table class="table table-striped">
                    <tr>
                        <th>Raport Semester 1</th>
                        <td>{{ $nilai_raport->nilai_raport_semester_1 }}</td>
                    </tr>
                    <tr>
                        <th>Raport Semester 2</th>
                        <td>{{ $nilai_raport->nilai_raport_semester_2 }}</td>
                    </tr>
                    <tr>
                        <th>Raport Semester 3</th>
                        <td>{{ $nilai_raport->nilai_raport_semester_3 }}</td>
                    </tr>
                    <tr>
                        <th>Raport Semester 4</th>
                        <td>{{ $nilai_raport->nilai_raport_semester_4 }}</td>
                    </tr>
                    <tr>
                        <th>Raport Semester 5</th>
                        <td>{{ $nilai_raport->nilai_raport_semester_5 }}</td>
                    </tr>
                </table>

                <a href="{{ route('upload_berkas') }}" class="btn btn-primary mt-3">
                    Lanjut Upload Berkas
                </a>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <h5 class="card-header fs-2 fw-bold">Nilai Raport</h5>
            <div class="card-body">
                <form action="{{ route('save_nilai_raport') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nilai-raport_semester-1" class="form-label">Nilai Raport Semester 1</label>
                        <input type="number" class="form-control @error('nilai_raport_semester_1') is-invalid @enderror" name="nilai_raport_semester_1" id="nilai-raport_semester-1"
                            placeholder="Isikan nilai akhir raport semester 1" />
                        @error('nilai_raport_semester_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai-raport_semester-2" class="form-label">Nilai Raport Semester 2</label>
                        <input type="number" class="form-control @error('nilai_raport_semester_2') is-invalid @enderror" name="nilai_raport_semester_2" id="nilai-raport_semester-2"
                            placeholder="Isikan nilai akhir raport semester 2" />
                        @error('nilai_raport_semester_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai-raport_semester-3" class="form-label">Nilai Raport Semester 3</label>
                        <input type="number" class="form-control @error('nilai_raport_semester_3') is-invalid @enderror" name="nilai_raport_semester_3" id="nilai-raport_semester-3"
                            placeholder="Isikan nilai akhir raport semester 3" />
                        @error('nilai_raport_semester_3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai-raport_semester-4" class="form-label">Nilai Raport Semester 4</label>
                        <input type="number" class="form-control @error('nilai_raport_semester_4') is-invalid @enderror" name="nilai_raport_semester_4" id="nilai-raport_semester-4"
                            placeholder="Isikan nilai akhir raport semester 4" />
                        @error('nilai_raport_semester_4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai-raport_semester-5" class="form-label">Nilai Raport Semester 5</label>
                        <input type="number" class="form-control @error('nilai_raport_semester_5') is-invalid @enderror" name="nilai_raport_semester_5" id="nilai-raport_semester-5"
                            placeholder="Isikan nilai akhir raport semester 5" />
                        @error('nilai_raport_semester_5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                </form>

            </div>

        </div>
    @endif
@endsection
