<!-- resources/views/livewire/document-uploader.blade.php -->
<div>
    @foreach ($types as $key => $label)
        <div class="row mb-3 align-items-end">
            <div class="col-sm-10">

                @php
                    $uploadRules = [
                        'foto' => [
                            'ext' => 'JPG/PNG',
                            'size' => '1MB'
                        ],
                        'kk' => [
                            'ext' => 'PDF',
                            'size' => '1MB'
                        ],
                        'ktp_orang_tua' => [
                            'ext' => 'JPG/PNG',
                            'size' => '1MB'
                        ],
                        'akte_lahir' => [
                            'ext' => 'PDF',
                            'size' => '1MB'
                        ]
                    ];
                @endphp
                <label class="form-label">
                    {{ $label }}
                    @php
                        $rule = $uploadRules[$key];
                    @endphp
                    <small class="text-muted">*{{ strtoupper($label) }} harus berupa {{ $rule['ext'] }}, maksimal {{ $rule['size'] }}</small>
                </label>

                @if (isset($documents[$key]))
                    <div class="text-success">
                        Sudah upload: {{ basename($documents[$key]) }}<br>
                        <a href="{{ asset('storage/' . $documents[$key]) }}" target="_blank"
                            class="btn btn-outline-secondary btn-sm mt-1">
                            Lihat
                        </a>
                    </div>
                @else
                    <input type="file" wire:model='fileInputs.{{ $key }}' class="form-control @error("fileInputs.$key") is-invalid @enderror">
                    <div wire:loading wire:target="fileInputs.{{ $key }}">
                        <small class="text-muted">Mengunggah...</small>
                    </div>

                    @error("fileInputs.$key")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                @endif

            </div>
            <div class="col-sm-2">
                @if (isset($documents[$key]))
                    <button class="btn btn-success w-100" disabled>
                        <i class="bi bi-check-circle"></i> Selesai
                    </button>
                @else
                    <button wire:click.prevent="save('{{ $key }}')" wire:loading.attr="disabled"
                        wire:target="save('{{ $key }}')" class="btn btn-primary w-100"
                        @if (empty($fileInputs[$key])) disabled @endif>
                        <span wire:loading.remove wire:target="save('{{ $key }}')">Upload</span>
                        <span wire:loading wire:target="save('{{ $key }}')">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </span>
                    </button>
                @endif
            </div>
        </div>
    @endforeach

    <div x-data="{ msg: null }"
        @success.window="msg = $event.detail.message">
        <template x-if="msg">
            <div class="alert alert-success mt-2" x-text="msg"></div>
        </template>
    </div>

</div>
