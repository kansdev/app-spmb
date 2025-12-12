<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WilayahIndonesia extends Component
{

    public $provinsi = [];
    public $kota = [];
    public $kecamatan = [];
    public $kelurahan = [];

    public $selectedProvinsi = null;
    public $selectedKota = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;

    public function mount()
    {
        // Load semua provinsi dari API
        $this->provinsi = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")->json();
    }

    public function updatedSelectedProvinsi($provinsiId)
    {
        $this->selectedKota = null;
        $this->selectedKecamatan = null;
        $this->selectedKelurahan = null;

        $this->kota = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json")->json();
    }

    public function updatedSelectedKota($kotaId)
    {
        $this->selectedKecamatan = null;
        $this->selectedKelurahan = null;

        $this->kecamatan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kotaId}.json")->json();
    }

    public function updatedSelectedKecamatan($kecamatanId)
    {
        $this->selectedKelurahan = null;

        $this->kelurahan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$kecamatanId}.json")->json();
    }

    public function render()
    {
        return view('livewire.wilayah-indonesia');
    }
}
