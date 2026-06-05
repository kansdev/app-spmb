<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Registrasi;

class RegistrasiController extends Controller
{
    public function data_registrasi($nomor_pendaftaran) {
        try {
            $data = Registrasi::where('nomor_pendaftaran', $nomor_pendaftaran)->first();
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data registrasi tidak ditemukan'
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function data_wawancara($nomor_pendaftaran) {
        try {
            $data = Registrasi::where('nomor_pendaftaran', $nomor_pendaftaran)->first();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }   
}
