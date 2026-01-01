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

    public function mount($siswa = null)
    {
        // Load semua provinsi dari API
        $this->provinsi = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")->json();

        if ($siswa) {
            $this->selectedProvinsi = $siswa->provinsi_id;
            $this->loadKota();

            $this->selectedKota = $siswa->kota_id;
            $this->loadKecamatan();

            $this->selectedKecamatan = $siswa->kecamatan_id;
            $this->loadKelurahan();

            $this->selectedKelurahan = $this->kelurahan_id;
        }
    }

    public function updatedSelectedProvinsi($provinsiId)
    {
        // $this->selectedKota = null;
        // $this->selectedKecamatan = null;
        // $this->selectedKelurahan = null;


        // $this->kota = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json")->json();

        $this->reset(['selectedKota', 'selectedKecamatan', 'selectedKelurahan']);
        $this->kota = $this->kecamatan = $this->kelurahan = [];
        $this->loadKota();
    }

    public function updatedSelectedKota($kotaId)
    {
        // $this->selectedKecamatan = null;
        // $this->selectedKelurahan = null;

        // $this->kecamatan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kotaId}.json")->json();

        $this->reset(['selectedKecamatan', 'selectedKelurahan']);
        $this->kecamatan = $this->kelurahan = [];
        $this->loadKecamatan();
    }

    public function updatedSelectedKecamatan($kecamatanId)
    {
        // $this->selectedKelurahan = null;

        // $this->kelurahan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$kecamatanId}.json")->json();

        $this->reset(['selectedKelurahan']);
        $this->kelurahan = [];
        $this->loadKelurahan();

    }

    public function loadProvinsi()
    {
        if ($this->selectedProvinsi) {
            $this->kota = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$this->selectedProvinsi}.json")->json();
        }
    }

    private function loadKecamatan()
    {
        if ($this->selectedKota) {
            $this->kecamatan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$this->selectedKota}.json")->json();
        }
    }

    private function loadKelurahan()
    {
        if ($this->selectedKecamatan) {
            $this->kelurahan = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$this->selectedKecamatan}.json")->json();
        }
    }

    public function render()
    {
        return view('livewire.wilayah-indonesia');
    }
}
