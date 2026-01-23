<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahService
{
    public static function provinsi($kode)
    {
        return Cache::remember("provinsi_$kode", now()->addDay(), function () use ($kode) {
            $response = Http::get(
                'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'
            );

            if (!$response->ok()) return $kode;

            return collect($response->json())
                ->firstWhere('id', substr($kode, 0, 2))['name'] ?? $kode;
        });
    }

    public static function kota($kode)
    {
        return Cache::remember("kota_$kode", now()->addDay(), function () use ($kode) {
            $provId = substr($kode, 0, 2);

            $response = Http::get(
                "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/$provId.json"
            );

            if (!$response->ok()) return $kode;

            return collect($response->json())
                ->firstWhere('id', substr($kode, 0, 4))['name'] ?? $kode;
        });
    }

    public static function kecamatan($kode)
    {        
        return Cache::remember("kecamatan_$kode", 86400, function () use ($kode) {
            $kotaId = substr($kode, 0, 4);

            $response = Http::get(
                "https://www.emsifa.com/api-wilayah-indonesia/api/districts/$kotaId.json"
            );

            if (!$response->ok()) return $kode;

            $data = collect($response->json());
            return $data->firstWhere('id', $kode)['name'] ?? $kode;
        });
    }

    public static function kelurahan($kode)
    {
        return Cache::remember("kelurahan_$kode", 86400, function () use ($kode) {
            $kecId = substr($kode, 0, 7);

            $response = Http::get(
                "https://www.emsifa.com/api-wilayah-indonesia/api/villages/$kecId.json"
            );

            if (!$response->ok()) return $kode;

            $data = collect($response->json());
            return $data->firstWhere('id', $kode)['name'] ?? $kode;
        });
    }
}
