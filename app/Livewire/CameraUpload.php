<?php

namespace App\Livewire;

use App\Models\IdCard;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CameraUpload extends Component
{

    public $nama, $kelas, $jurusan;
    public $foto;

    public $idcard;

    protected $listeners = ['setFoto'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->idcard = \App\Models\IdCard::latest()->get();
    }

    public function submitForm()
    {
        $this->validate([
            'nama'     => 'required|string',
            'kelas'    => 'required|string',
            'jurusan'  => 'required|string',
        ]);

        $this->dispatch('bukaKamera');
    }

    public function bukaKamera()
    {
        // Kosong, hanya untuk event
    }

    public function setFoto(String $dataUrl)
    {
        $this->foto = $dataUrl;
    }

    public function saveWithPhoto()
    {
        $this->validate([
            'foto' => 'required',
            'nama' => 'required|string',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $image = str_replace('data:image/png;base64,', '', $this->foto);
        $image = str_replace(' ', '+', $image);
        $binary = base64_decode($image);
        $filename = 'foto_' . time() . '.png';

        $path = 'uploads/foto/' . $filename;
        Storage::disk('public')->put('uploads/foto/' . $filename, $binary);

        // Simpan ke database
        IdCard::create([
            'nama'      => $this->nama,
            'kelas'     => $this->kelas,
            'jurusan'   => $this->jurusan,
            'foto_path' => $path,
        ]);


        $this->reset(['nama', 'kelas', 'jurusan', 'foto']);
        session()->flash('message', 'Data & foto berhasil disimpan.');

        $this->dispatch('close-modal');

        $this->loadData();
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.camera-upload');
    }
}
