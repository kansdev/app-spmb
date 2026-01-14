<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DocumentUpload;
use Illuminate\Support\Facades\Auth;

class DocumentUploader extends Component
{

    use WithFileUploads;

    public $fileInputs = [];
    public $documents = [];

    public $types = [
        'foto' => 'Foto',
        'kk' => 'Kartu Keluarga',
        'ktp_orang_tua' => 'KTP Orang Tua',
        'akte_lahir' => 'Akte Kelahiran',
    ];

    public $rules = [
        'fileInputs.foto' => 'required|mimes:jpg,jpeg,png|max:1024',
        'fileInputs.kk' => 'required|mimes:pdf|max:1024',
        'fileInputs.ktp_orang_tua' => 'required|mimes:jpg,jpeg,png|max:1024',
        'fileInputs.akte_lahir' => 'required|mimes:pdf|max:1024',
    ];

    public function mount()
    {
        // Periksa otentikasi
        if (!Auth::check()) {
            abort(403);
        }

        // Ambil data berdasarkan id user
        $uploads = DocumentUpload::where('user_id', Auth::id())->get();

        // Map file
        foreach ($uploads as $upload) {
            $this->documents[$upload->type] = $upload->file_path;
        }
    }

    public function save($type)
    {
        // Validasi input file max 1mb bentuk pdf
        $this->validate([
            "fileInputs.$type" => $this->rules["fileInputs.$type"]
        ], [
            "fileInputs.$type.mimes" => "Format file tidak sesuai untuk " . ($this->types[$type] ?? $type),
            "fileInputs.$type.max" => "Ukuran file tidak boleh lebih dari 1Mb",
        ]);

        // simpan Log
        logger($type);
        logger($this->fileInputs);

        // Variabel untuk menyimpan nama file
        // inisialisasi lokasi penyimpanan pada store uploads/document/nama_folder_file/nama_file
        $file = $this->fileInputs[$type];
        $path = $file->store("uploads/document/$type", 'public');

        // Simpan file ke database
        DocumentUpload::updateOrCreate(
            ['user_id' => Auth::id(), 'type' => $type],
            ['file_path' => $path]
        );

        // Update status ketika berkas di upload ulang dengan status ditolak
        $user = Auth::user();
        if ($user->registrasi && $user->registrasi->status === 'Ditolak') {
            $user->registrasi()->update([
                'status' => 'Belum Terverifikasi'
            ]);
        }

        // Menyimpan ke lokasi penyimpanan
        $this->documents[$type] = $path;
        $this->fileInputs[$type] = null;

        // Tampilkan pesan ketika berhasil di upload
        $this->dispatch('success', message : ($this->types[$type] ?? ucfirst($type)) . " berhasil diupload.");
    }

    public function render()
    {
        $data = DocumentUpload::where('user_id', Auth::id())->get();
        return view('livewire.document-uploader', $data);
    }
}
