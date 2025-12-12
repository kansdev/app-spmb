@extends('layouts.main')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header fs-2 fw-bold">Upload Berkas</h5>
        <div class="card-body">
            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="ktp" class="form-label">Kartu Tanda Penduduk</label>
                        <input type="file" class="form-control" name="ktp" id="ktp">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="kk" class="form-label">Kartu Keluarga</label>
                        <input type="file" class="form-control" name="kk" id="kk">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="akte-lahir" class="form-label">Akte Kelahiran</label>
                        <input type="file" class="form-control" name="akte_lahir" id="akte-lahir">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="ktp-orang-tua" class="form-label">KTP Orang Tua</label>
                        <input type="file" class="form-control" name="ktp_orang_tua" id="ktp-orang-tua">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="skl" class="form-label">Surat Keterangan Lulus</label>
                        <input type="file" class="form-control" name="skl" id="skl">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="raport" class="form-label">Raport SMP</label>
                        <input type="file" class="form-control" name="raport" id="raport">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>

            <form action="" method="post">
                <div class="row mb-3 align-items-end">
                    <div class="col-sm-10">
                        <label for="kartu-pkh-kps" class="form-label">Kartu PKH/KPS</label>
                        <input type="file" class="form-control" name="raport" id="raport">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-md w-100">Upload</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
