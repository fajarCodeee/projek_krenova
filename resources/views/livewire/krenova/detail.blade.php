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
            {{-- {{ $proposal_lomba }} --}}
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
                        id="address" disabled></textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                    <select class="form-select @error('province')
                is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="province" id="province"
                        wire:change="loadRegencyName($event.target.value)" disabled>
                        <option selected value=""> --- Pilih Provinsi --- </option>
                        @foreach ($provinces as $prov)
                            {{-- <option value="{{ $prov['kode'] }}">{{ $prov['nama'] }}</option> --}}
                            <option value="{{ $prov['kode'] }}" {{ $prov['kode'] == $province ? 'selected' : '' }}>
                                {{ $prov['nama'] }}
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
                        wire:change="loadSubdistrictName($event.target.value)" disabled>
                        @if (!is_null($regences))
                            <option selected value=""> --- Pilih Kabupaten / Kota --- </option>
                            @forelse ($regences as $regency)
                                {{-- <option value="{{ $regency['kode'] }}">{{ $regency['nama'] }}</option> --}}
                                <option value="{{ $regency['kode'] }}"
                                    {{ $regency['kode'] == $this->regency ? 'selected' : '' }}>
                                    {{ $regency['nama'] }}
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
                        aria-label="Default select example" wire:model="subdistrict" id="subdistrict" disabled
                        wire:change="loadVillageName($event.target.value)">
                        @if (!is_null($subdistricts))
                            <option selected value=""> --- Pilih Kelurahan --- </option>
                            @forelse ($subdistricts as $subdistrict)
                                {{-- <option value="{{ $subdistrict['kode'] }}">{{ $subdistrict['nama'] }}</option> --}}
                                <option value="{{ $subdistrict['kode'] }}"
                                    {{ $subdistrict['kode'] == $this->subdistrict ? 'selected' : '' }}>
                                    {{ $subdistrict['nama'] }}
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
                        aria-label="Default select example" wire:model="village" id="village" disabled>
                        @if (!is_null($villages))
                            <option selected value=""> --- Pilih Kelurahan --- </option>
                            @forelse ($villages as $village)
                                {{-- <option value="{{ $village['kode'] }}">{{ $village['nama'] }}</option> --}}
                                <option value="{{ $village['kode'] }}"
                                    {{ $village['kode'] == $this->village ? 'selected' : '' }}>
                                    {{ $village['nama'] }}
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
                        id="number_phone" wire:model="number_phone" required disabled>
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
                        id="innovation_title" wire:model.defer="innovation_title" required disabled>
                    @error('innovation_title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_competition" class="form-label">Kategori Lomba
                        {{ Storage::url('7/bPSvJr3YULlIcRudNLH9AWuLAGjnZy-metaZmlybWFuLnBkZg==-.pdf') }} <span
                            class="text-danger">*</span></label>
                    <select
                        class="form-select @error('category_competition')
                is-invalid
            @enderror"
                        aria-label="Default select example" wire:model="category_competition"
                        id="category_competition" disabled>
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
                        id="participant_category" disabled>
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
            @enderror" id="abstract" disabled></textarea>
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
                        id="innovation_excellence" disabled></textarea>
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
                        id="benefits_of_innovation" disabled></textarea>
                    @error('benefits_of_innovation')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="applications_to_society" class="form-label">Penerapan pada Masyarakat <span
                            class="text-danger">*</span></label>
                    <br>
                    <textarea wire:model="applications_to_society" class="form-control" id="applications_to_society" disabled></textarea>
                    @error('applications_to_society')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="link_video_innovation" class="form-label">Link Video Inovasi (Jika Ada)</label>
                    <input type="text" class="form-control" id="link_video_innovation"
                        wire:model="link_video_innovation" disabled>
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
                <span>Surat Pernyataan Keaslian (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    {{-- <iframe src="{{ $surat_pernyataan }}" width="100%" height="600px"></iframe> --}}
                    <a href="{{ $surat_pernyataan }}" target="_blank" rel="noopener noreferrer">Lihat</a>
                </div>
                <span>Foto Kopi Identitas (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    {{-- <iframe src="{{ $fotokopi_identitas }}" width="100%" height="600px"></iframe> --}}
                    <a href="{{ $fotokopi_identitas }}" target="_blank" rel="noopener noreferrer">Lihat</a>
                </div>
                <span>Proposal Lomba (.pdf) <span class="text-danger">*</span></span>
                <div class="input-group mb-3">
                    {{-- <iframe src="{{ $proposal_lomba }}" width="100%" height="600px"></iframe> --}}
                    <a href="{{ $proposal_lomba }}" target="_blank" rel="noopener noreferrer">Lihat</a>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"
                        wire:click="previousStep">Kembali</button>
                </div>
            </div>
        @endif
    </div>

</div>

@push('script')
    @livewireScripts
@endpush
