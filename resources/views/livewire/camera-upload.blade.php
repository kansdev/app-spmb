<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#dataModal">
            <i class="fa-solid fa-print"></i> Cetak Kartu
        </button>
    </div>

    <div>
        {{-- Form Input --}}
        <form wire:submit.prevent="submitForm" class="mb-4">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" wire:model="nama">
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Kelas</label>
                <input type="text" class="form-control" wire:model="kelas">
                @error('kelas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Jurusan</label>
                <input type="text" class="form-control" wire:model="jurusan">
                @error('jurusan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lanjutkan & Ambil Foto</button>
        </form>

        {{-- Modal Camera --}}
        <div wire:ignore.self class="modal fade" id="cameraModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ambil Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <video id="camera" autoplay playsinline class="border rounded"
                            style="width:100%; max-width:500px"></video><br>
                        <button class="btn btn-outline-primary mt-3" onclick="takeSnapshot()">Ambil Foto</button>
                        @if ($foto)
                            <img src="{{ $foto }}" class="img-thumbnail mt-3" width="300">
                        @endif
                    </div>

                    <div class="modal-footer">
                        @if ($foto)
                            <button wire:click="saveWithPhoto" class="btn btn-success">Simpan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <canvas id="canvas" class="d-none"></canvas>

        @if (session()->has('message'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Modal Tabel Data -->
        <div wire:ignore.self class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table id="siswaTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($idcard as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        {{-- <td>{{ $item->foto_path }}</td> --}}
                                        <td>
                                            @if ($item->foto_path)
                                                <img src="{{ asset('storage/' . $item->foto_path) }}" alt="foto"
                                                    width="60">
                                            @endif
                                        </td>
                                        <td>
                                            <button onclick="openPrintWindow('{{ url('/idcard/pdf/' . $item->id) }}')"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-print"></i> Cetak
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                let table = new DataTable('#siswaTable', {
                    responsive: true,
                    autoWidth: false,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/id.json'
                    }
                });

                window.addEventListener('refreshTable', () => {
                    table.destroy();
                    setTimeout(() => {
                        new DataTable('#siswaTable');
                    }, 300);
                });
            });
        </script>
    @endpush



</div>
