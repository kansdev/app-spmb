@extends('layouts.main')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header fs-2 fw-bold">ID Card</h5>
        <div class="card-body">
            @livewire('camera-upload')
        </div>
    </div>
@endsection
