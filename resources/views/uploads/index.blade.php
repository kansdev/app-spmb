@extends('layouts.main')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    <div class="alert alert-warning ">
        Silahkan klik menu registrasi jika anda sudah melakukan upload berkas seluruhnya.
    </div>
    <div class="card mb-4">
        <h5 class="card-header fs-2 fw-bold">Upload Berkas</h5>
        <div class="card-body">
            @livewire('document-uploader')
        </div>
    </div>
@endsection
