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
        <h5 class="card-header fs-2 fw-bold">Nilai Raport</h5>
        <div class="card-body">
            <form action="{{ route('save_nilai_raport') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="nilai-raport_semester-1" class="form-label">Nilai Raport Semester 1</label>
                    <input type="number" class="form-control" name="nilai_raport_semester_1" id="nilai-raport_semester-1"
                        placeholder="Isikan nilai akhir raport semester 1" />
                </div>

                <div class="form-group mb-3">
                    <label for="nilai-raport_semester-2" class="form-label">Nilai Raport Semester 2</label>
                    <input type="number" class="form-control" name="nilai_raport_semester_2" id="nilai-raport_semester-2"
                        placeholder="Isikan nilai akhir raport semester 2" />
                </div>

                <div class="form-group mb-3">
                    <label for="nilai-raport_semester-3" class="form-label">Nilai Raport Semester 3</label>
                    <input type="number" class="form-control" name="nilai_raport_semester_3" id="nilai-raport_semester-3"
                        placeholder="Isikan nilai akhir raport semester 3" />
                </div>

                <div class="form-group mb-3">
                    <label for="nilai-raport_semester-4" class="form-label">Nilai Raport Semester 4</label>
                    <input type="number" class="form-control" name="nilai_raport_semester_4" id="nilai-raport_semester-4"
                        placeholder="Isikan nilai akhir raport semester 4" />
                </div>

                <div class="form-group mb-3">
                    <label for="nilai-raport_semester-5" class="form-label">Nilai Raport Semester 5</label>
                    <input type="number" class="form-control" name="nilai_raport_semester_5" id="nilai-raport_semester-5"
                        placeholder="Isikan nilai akhir raport semester 5" />
                </div>

                <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
            </form>

        </div>

    </div>
@endsection
