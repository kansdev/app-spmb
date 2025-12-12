<div>
    {{-- Stop trying to control. --}}
    {{-- Provinsi, Kota, Kecamatan, Kelurahan --}}
    <div class="row mb-3">
                        <!-- Provinsi -->
        <div class="col-md-3">
            <label class="form-label">Provinsi</label>
            <select class="form-control" name="provinsi" wire:model="selectedProvinsi" wire:key="provinsi">
                <option value="">-- Pilih Provinsi --</option>
                @foreach ($provinsi as $prov)
                    <option value="{{ $prov['id'] }}">{{ $prov['name'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Kota -->
        <div class="col-md-3">
            <label class="form-label">Kota / Kabupaten</label>
            <select class="form-control" name="kota" wire:model="selectedKota" wire:key="kota">
                <option value="">-- Pilih Kota --</option>
                @foreach ($kota as $k)
                    <option value="{{ $k['id'] }}">{{ $k['name'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Kecamatan -->
        <div class="col-md-3">
            <label class="form-label">Kecamatan</label>
            <select class="form-control" wire:model="selectedKecamatan" wire:key="kecamatan">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatan as $kec)
                    <option value="{{ $kec['id'] }}">{{ $kec['name'] }}</option>
                    {{-- <option value="{{ $kec['id'] }}">{{ dd($kec['name']) }}</option> --}}
                @endforeach
            </select>
        </div>

        <!-- Kelurahan -->
        <div class="col-md-3">
            <label class="form-label">Kelurahan</label>
            <select class="form-control" wire:model="selectedKelurahan" wire:key="kelurahan">
                <option value="">-- Pilih Kelurahan --</option>
                @foreach ($kelurahan as $kel)
                    <option value="{{ $kel['id'] }}">{{ $kel['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
