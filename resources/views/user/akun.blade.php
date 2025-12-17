@extends('layouts.main')

@section('content')

    {{-- Tampilkan pesan error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    <div class="card shadow-sm rounded">
        <div class="row g-0">
            <!-- Foto Profil -->
            <div class="col-md-4 d-flex justify-content-center align-items-center p-3 bg-light rounded-circle">
                <img src="{{ $user->avatar }}" class="img-fluid rounded-circle" alt="Foto Profil"
                    style="width: 150px; height: 150px; object-fit: cover;" loading="eager">
            </div>
            <!-- Detail Profil -->
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ $user->name }}</h4>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Nomor Telepon:</strong> {{ $user->phone }}</p>
                    <p class="card-text"><strong>Update Account:</strong> {{ $user->updated_at }}</p>
                    @if (!empty(Auth::user()->phone))
                        <button class="btn btn-secondary mt-3" disabled>Profil Sudah Lengkap</button>
                    @else
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#profileModal">Edit Profil</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update_akun') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Nomor WA Aktif</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Masukan nomor WA yang aktif" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
