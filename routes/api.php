<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegistrasiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/data-registrasi/interview/{nomor_pendaftaran}', [RegistrasiController::class, 'data_full_registrasi']);
Route::post('/data-registrasi/{nomor_pendaftaran}', [RegistrasiController::class, 'data_registrasi']);