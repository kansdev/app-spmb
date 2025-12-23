@extends('layouts.main')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang 🎉</h5>
                    <p class="mb-4">
                        Sistem ini adalah sistem untuk pendaftaran siswa baru melalui program
                        beasiswa yang di selenggarakan oleh Sekolah Nusantara 1 kota Tangerang
                        bekerja sama dengan Yayasan Pendidikan Abdi Negara selaku yayasan dari
                        Sekolah Nusantara 1 Kota Tangerang
                    </p>

                    <a href="#" class="btn btn-md btn-outline-primary" data-bs-target="#alur" data-bs-toggle="modal">Lihat Cara
                        Mendaftar</a>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="/assets/img/illustrations/happy-student-pana.png" height="240" alt="View Badge User" />
                </div>
            </div>
        </div>
    </div>

    @php
        $requiredFiles = ['foto', 'kk', 'ktp_ayah', 'ktp_ibu', 'akte_lahir'];
        $allUploaded = true;

        $uploads = $user->upload->pluck('file_path', 'type');

        foreach ($requiredFiles as $file) {
            if (!isset($uploads[$file])) {
                $allUploaded = false;
                break;
            }
        }
    @endphp
    <div class="card mt-4">
        <div class="card-body">
            <h5>Status Pengisian :</h5>
            <div class="status-wrapper">
                <div class="status-step">
                    <a href="{{ route('akun') }}">
                        <div class="circle {{ $user->phone ? 'success' : 'danger' }}"><i class="fas fa-user"></i></div>
                        <span>Profil</span>
                    </a>
                </div>

                <div class="status-line"></div>

                <div class="status-step">
                    <a href="{{ route('formulir_siswa') }}">
                        <div class="circle {{ $user->siswa ? 'success' : 'danger' }}"><i class="fas fa-child"></i></div>
                        <span>Siswa</span>
                    </a>
                </div>

                <div class="status-line"></div>

                <div class="status-step">
                    <a href="{{ route('formulir_orang_tua') }}">
                        <div class="circle {{ $user->orang_tua ? 'success' : 'danger' }}"><i class="fas fa-users"></i></div>
                        <span>Orang Tua</span>
                    </a>
                </div>

                <div class="status-line"></div>

                <div class="status-step">
                    <a href="{{ route('formulir_periodik') }}">
                        <div class="circle {{ $user->periodik ? 'success' : 'danger' }}"><i class="fas fa-list"></i></div>
                        <span>Periodik</span>
                    </a>
                </div>

                <div class="status-line"></div>

                <div class="status-step">
                    <a href="{{ route('formulir_nilai_raport') }}">
                        <div class="circle {{ $user->nilai_raport ? 'success' : 'danger' }}"><i class="fas fa-file-alt"></i></div>
                        <span>Raport</span>
                    </a>
                </div>

                <div class="status-line"></div>

                <div class="status-step">
                    <a href="{{ route('upload_berkas') }}">
                        <div class="circle {{ $allUploaded ? 'success' : 'danger' }}"><i class="fas fa-upload"></i></div>
                        <span>Berkas</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alur">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-0" style="border:none; background: transparent">
                <div class="modal-body p-0">
                    <img src="/assets/img/poster/alur.jpg" class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jurusan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content p-0" style="border:none; background: transparent">
                <div class="modal-body p-0">
                    <img src="/assets/img/poster/jurusan.jpg" class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var popup = new bootstrap.Modal(document.getElementById('jurusan'), {
                keyboard: true
            });
            popup.show();
        })
    </script>


@endsection

<!-- / Content -->
