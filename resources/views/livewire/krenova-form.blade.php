<div>
    <div>
        <div class="progress px-1" style="height: 3px;">
            <div class="progress-bar" role="progressbar" style="width: {{ ($currentStep - 1) * 33.33 }}%;"
                aria-valuenow="{{ ($currentStep - 1) * 33.33 }}" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <div class="step-container d-flex justify-content-between">
            <div class="step-circle bg-white" onclick="displayStep(1)">1</div>
            <div class="step-circle bg-white" onclick="displayStep(2)">2</div>
            <div class="step-circle bg-white" onclick="displayStep(3)">3</div>
            <div class="step-circle bg-white" onclick="displayStep(4)">4</div>
        </div>

        @if ($currentStep == 1)
            <div class="step step-1 m-2">
                <!-- Step 1 form fields here -->
                <h3>1. Data Pribadi</h3>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('full_name')
                is-invalid
            @enderror"
                        id="full_name" wire:model="full_name" required disabled>
                    @error('full_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="address" class="form-control @error('address')
                is-invalid
            @enderror"
                        id="address"></textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                    <select
                        class="form-select @error('province')
                    is-invalid
                    @enderror"
                        aria-label="Default select example" wire:model="province" id="province"
                        wire:change="loadRegencyName($event.target.value)">
                        <option selected value=""> --- Pilih Provinsi --- </option>
                        @foreach ($provinces['data'] as $prov)
                            {{-- <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option> --}}
                            <option value="{{ $prov['code'] }}" {{ $prov['code'] == $province ? 'selected' : '' }}>
                                {{ $prov['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('province')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                {{-- @dd($regences) --}}
                <div class="mb-3">
                    <label for="regency" class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                    <select class="form-select @error('regency')
                is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="regency" id="regency"
                        wire:change="loadSubdistrictName($event.target.value)">
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
                    <label for="subdistrict" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                    <select class="form-select @error('subdistrict')
            is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="subdistrict" id="subdistrict"
                        wire:change="loadVillageName($event.target.value)">
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
                            <option selected value=""> --- Pilih Kabupaten / Kota Terlebih Dahulu --- </option>
                        @endif
                    </select>
                    @error('subdistrict')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="village" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                    <select
                        class="form-select @error('village')
                        is-invalid
                        @enderror"
                        aria-label="Default select example" wire:model="village" id="village">
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
                <div class="mb-3">
                    <label for="number_phone" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('number_phone')
                is-invalid
            @enderror"
                        id="number_phone" wire:model="number_phone" required>
                    @error('number_phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('email')
                is-invalid
            @enderror"
                        id="email" wire:model="email" required disabled>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="button" class="btn btn-primary next-step" wire:click="stepOne">Next</button>
            </div>
        @elseif($currentStep == 2)
            <div class="step step-2 m-2">
                <!-- Step 2 form fields here -->
                <h3>2. Judul dan Bidang Fokus</h3>
                <div class="mb-3">
                    <label for="innovation_title" class="form-label">Judul Inovasi <span
                            class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('innovation_title')
                is-invalid
            @enderror"
                        id="innovation_title" wire:model.defer="innovation_title" required>
                    @error('innovation_title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_competition" class="form-label">Kategori Lomba <span
                            class="text-danger">*</span></label>
                    <select
                        class="form-select @error('category_competition')
                is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="category_competition"
                        id="category_competition">
                        <option selected value=""> --- Pilih Kategori Lomba ---</option>
                        <option value="energi">Energi dan Rekayasa Teknologi Manufaktur</option>
                        <option value="kelautan-perikanan">Industri Kreatif</option>
                        <option value="kesehatan">Kesehatan</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="kehutanan">Pertanian dan Pangan</option>
                        <option value="teknologi-komunikasi">Teknologi Informasi dan Komunikasi</option>
                    </select>
                    @error('category_competition')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"
                        wire:click="previousStep">Kembali</button>
                    <button type="button" class="btn btn-primary next-step" wire:click="stepTwo">Next</button>
                </div>
            </div>
        @elseif($currentStep == 3)
            <div class="step step-3 m-2">
                <!-- Step 3 form fields here -->
                <h3>3. Rincian Inovasi</h3>
                <div class="mb-3">
                    <label for="innovation_title" class="form-label">Judul Inovasi <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="innovation_title" wire:model="innovation_title"
                        required readonly>
                </div>
                {{-- <span class="form-label">Peserta <span class="text-danger">*</span></span> --}}
                <div class="mb-3">
                    <label for="participant_category" class="form-label">Peserta <span
                            class="text-danger">*</span></label>
                    <select
                        class="form-select @error('participant_category')
                is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="participant_category"
                        id="participant_category">
                        <option selected value=""> --- Pilih Kategori Peserta --- </option>
                        <option value="Masyarakat Umum">Masyarakat Umum</option>
                        <option value="Pelajar / Mahasiswa / Dosen / Guru / PNS / TNI / Polri">Pelajar / Mahasiswa /
                            Dosen / Guru / PNS / TNI / Polri</option>
                    </select>
                    @error('participant_category')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                @error('participant_category')
                    <span>{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="abstract" class="form-label">Abstrak <span class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="abstract"
                        class="form-control @error('abstract')
                is-invalid
            @enderror" id="abstract"></textarea>
                    @error('abstract')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="innovation_excellence" class="form-label">Keunggulan Inovasi <span
                            class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="innovation_excellence"
                        class="form-control @error('innovation_excellence')
                is-invalid
            @enderror"
                        id="innovation_excellence"></textarea>
                    @error('innovation_excellence')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="benefits_of_innovation" class="form-label">Manfaat Inovasi <span
                            class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="benefits_of_innovation"
                        class="form-control @error('benefits_of_innovation')
                is-invalid
            @enderror"
                        id="benefits_of_innovation"></textarea>
                    @error('benefits_of_innovation')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="applications_to_society" class="form-label">Penerapan pada Masyarakat <span
                            class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="applications_to_society" class="form-control" id="applications_to_society"></textarea>
                    @error('applications_to_society')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="link_video_innovation" class="form-label">Link Video Inovasi (Jika Ada)</label>
                    <input type="text" class="form-control" id="link_video_innovation"
                        wire:model="link_video_innovation">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"
                        wire:click="previousStep">Kembali</button>
                    <button type="button" class="btn btn-primary next-step" wire:click="stepThree">Next</button>
                </div>
            </div>
        @elseif($currentStep == 4)
            <div class="step step-4 m-2">
                <!-- Step 4 form fields here -->
                <h3>4. Dokumen Pendukung</h3>

                <div class="mb-3">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click='downloadSurat'>Unduh Surat
                        Penyataan Keaslian <i class='bx bx-download'></i></button>
                </div>
                <span>Surat Pernyataan Keaslian (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    <input type="file"
                        class="form-control @error('surat_pernyataan')
                        is-invalid
                    @enderror"
                        id="surat_pernyataan" wire:model='surat_pernyataan'>
                    {{-- <label class="input-group-text" for="surat_pernyataan">Upload</label> --}}
                    @error('surat_pernyataan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <span>Foto Kopi Identitas (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    <input type="file"
                        class="form-control @error('fotokopi_identitas')
                        is-invalid
                    @enderror"
                        id="fotokopi_identitas" wire:model='fotokopi_identitas'>
                    {{-- <label class="input-group-text" for="fotokopi_identitas">Upload</label> --}}
                    @error('fotokopi_identitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <span>Proposal Lomba (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    <input type="file"
                        class="form-control @error('proposal_lomba')
                        is-invalid
                    @enderror"
                        id="proposal_lomba" wire:model='proposal_lomba'>
                    {{-- <label class="input-group-text" for="proposal_lomba">Upload</label> --}}
                    @error('proposal_lomba')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"
                        wire:click="previousStep">Kembali</button>
                    <button type="submit" class="btn btn-success" wire:click='submit'>Submit</button>
                </div>
            </div>
        @endif
    </div>

</div>

@push('script')
    @livewireScripts
@endpush
