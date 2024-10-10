<div class="card">
    <div class="card-body">
        <h6 class="mb-0 text-uppercase">{{ $title_page ?? '' }}</h6>
        <hr />

        <div id="container" class="container">
            <form wire:submit='submit'>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <x-input-field label="Nama Lengkap" required="true" model="full_name" disable='true' />

                        <x-input-field label="Judul Penelitian" required="true" model='research_title'
                            :disable="$is_edit == true ? false : true" />

                        <x-input-field label="Instansi" required="true" model='institution' :disable="$is_edit == true ? false : true" />

                        <x-input-field label="Abstraksi" type="textarea" required="true" model='abstraction'
                            :disable="$is_edit == true ? false : true" />

                        <span>Proposal Penelitian (.pdf) <span class="text-danger">*</span></span>
                        <div class="input-group mb-3">
                            @if ($is_edit == true)
                                <input type="file" class="form-control" id="proposal_penelitian"
                                    accept="application/pdf" wire:model='proposal_penelitian'>
                            @else
                                <a href="{{ $proposal_penelitian }}" target="_blank">Lihat Dokumen <i
                                        class='bx bx-link-external'></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <x-input-field label="Lokasi Penelitian" required="true" model='address' :disable="$is_edit == true ? false : true" />

                        <div class="mb-3">
                            <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                            <select
                                class="form-select @error('province')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" wire:model="province" id="province" disabled>
                                <option selected value=""> --- Pilih Provinsi --- </option>
                                @foreach ($provinces['data'] as $prov)
                                    {{-- <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option> --}}
                                    <option value="{{ $prov['code'] }}"
                                        {{ $prov['code'] == $province ? 'selected' : '' }}>
                                        {{ $prov['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="regency" class="form-label">Kabupaten/Kota <span
                                    class="text-danger">*</span></label>
                            <select
                                class="form-select @error('regency')
                                is-invalid
                            @enderror"
                                aria-label="Default select example" wire:model.defer="regency" id="regency" disabled>
                                @if (!is_null($regences))
                                    <option selected value=""> --- Pilih Kabupaten / Kota --- </option>
                                    @forelse ($regences['data'] as $regency)
                                        {{-- <option value="{{ $regency['code'] }}">{{ $regency['name'] }}</option> --}}
                                        <option value="{{ $regency['code'] }}"
                                            {{ $regency['code'] == $this->regency ? 'selected' : '' }}>
                                            {{ $regency['name'] }}
                                        </option>

                                    @empty
                                    @endforelse
                                @else
                                    <option selected value=""> --- Pilih Provinsi Terlebih Dahulu --- </option>
                                @endif
                            </select>
                            @error('regency')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subdistrict" class="form-label">Kecamatan <span
                                    class="text-danger">*</span></label>
                            <select
                                class="form-select @error('subdistrict')
                                is-invalid
                                @enderror"
                                aria-label="Default select example" wire:model="subdistrict" id="subdistrict"
                                wire:change="loadVillageName($event.target.value)"
                                @if ($is_edit == false) disabled @endif>
                                @if (!is_null($subdistricts))
                                    <option selected value=""> --- Pilih Kecamatan --- </option>
                                    @forelse ($subdistricts['data'] as $subdistrict)
                                        {{-- <option value="{{ $subdistrict['code'] }}">{{ $subdistrict['name'] }}</option> --}}
                                        <option value="{{ $subdistrict['code'] }}"
                                            {{ $subdistrict['code'] == $this->subdistrict ? 'selected' : '' }}>
                                            {{ $subdistrict['name'] }}
                                        </option>

                                    @empty
                                    @endforelse
                                @else
                                    <option selected value=""> --- Pilih Kabupaten / Kota Terlebih Dahulu ---
                                    </option>
                                @endif
                            </select>
                            @error('subdistrict')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="village" class="form-label">Kelurahan <span
                                    class="text-danger">*</span></label>
                            <select
                                class="form-select @error('village')
                                is-invalid
                                @enderror"
                                aria-label="Default select example" wire:model="village" id="village"
                                @if ($is_edit == false) disabled @endif>
                                @if (!is_null($villages))
                                    <option selected value=""> --- Pilih Kelurahan --- </option>
                                    @forelse ($villages['data'] as $village)
                                        {{-- <option value="{{ $village['code'] }}">{{ $village['name'] }}</option> --}}
                                        <option value="{{ $village['code'] }}"
                                            {{ $village['code'] == $this->village ? 'selected' : '' }}>
                                            {{ $village['name'] }}
                                        </option>

                                    @empty
                                    @endforelse
                                @else
                                    <option selected value=""> --- Pilih Kecamatan Terlebih Dahulu ---
                                    </option>
                                @endif
                            </select>
                            @error('subdistrict')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>
                        {{-- <x-input-field label="Kelurahan" model="village" /> --}}
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

@push('css')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush

@push('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
