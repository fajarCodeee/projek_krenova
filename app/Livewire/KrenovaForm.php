<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\FormKrenovaDraft;
use PhpOffice\PhpWord\TemplateProcessor;

class KrenovaForm extends Component
{

    use WithFileUploads;

    public $currentStep = 1;
    public $full_name, $address, $province, $regency, $subdistrict, $village, $number_phone, $email;
    public $innovation_title, $category_competition;
    public $participant_category, $abstract, $innovation_excellence, $benefits_of_innovation, $applications_to_society, $link_video_innovation = '';
    public $surat_pernyataan;
    public $fotokopi_identitas;
    public $proposal_lomba;
    public $message;

    public $provinces = [];
    public $regences = null;
    public $subdistricts = null;
    public $villages = null;

    public $form_id = null;

    public function mount()
    {
        $user = User::find('1');

        $this->loadProfile();
        $this->getProvinceName();

        if ($this->province) {
            // Jika ada provinsi, muat kabupaten yang sesuai
            $this->loadRegencyName($this->province);
        }

        if ($this->regency) {
            // Jika ada kabupaten, muat kecamatan yang sesuai
            $this->loadSubdistrictName($this->regency);
        }

        if ($this->subdistrict != null) {
            $this->loadVillageName($this->subdistrict);
        }

        if (!is_null($this->form_id)) {
            $form = $user->hasFormKrenovaDraft()->where('id', $this->form_id)->first();
            if (is_null($form)) {
                $form = $user->hasFormKrenova()->where('id', $this->form_id)->first();
            }
            $this->innovation_title = $form->innovation_title;
            $this->category_competition = $form->competition_category;
            $this->participant_category = $form->participant_category;
            $this->abstract = $form->abstract;
            $this->innovation_excellence = $form->innovation_excellence;
            $this->benefits_of_innovation = $form->benefits_of_innovation;
            $this->applications_to_society = $form->applications_to_society;
            $this->link_video_innovation = $form->link_video_innovation;
        }
    }

    public function getProvinceName()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://wilayah.id/api/provinces.json');
        $this->provinces = json_decode($response->getBody(), true);
    }

    public function loadRegencyName($prov_code)
    {
        $url = 'https://wilayah.id/api/regencies/' . $prov_code . '.json';

        $client = new Client();
        $response = $client->request('GET', $url);
        $this->regences = json_decode($response->getBody(), true);
    }

    public function loadSubdistrictName($regency_code)
    {
        $url = 'https://wilayah.id/api/districts/' . $regency_code . '.json';

        $client = new Client();
        $response = $client->request('GET', $url);
        $this->subdistricts = json_decode($response->getBody(), true);
    }

    public function loadVillageName($subdistrict_code)
    {
        $url = 'https://wilayah.id/api/villages/' . $subdistrict_code . '.json';

        $client = new Client();
        $response = $client->request('GET', $url);
        $this->villages = json_decode($response->getBody(), true);
    }

    public function loadProfile()
    {
        $user = User::find('1');

        $this->full_name = $user->fullname ?? '';
        $this->address = $user->address ?? '';
        $this->province = $user->province ?? '';
        $this->regency = $user->regency ?? '';
        $this->subdistrict = $user->subdistrict ?? '';
        $this->village = $user->village ?? '';
        $this->number_phone = $user->number_phone ?? '';
        $this->email = $user->email ?? '';
    }

    public function updated($field)
    {
        $this->saveDraft(); // Save draft automatically when any field is updated
    }

    // save draft
    public function saveDraft()
    {
        $draft = [
            'full_name' => $this->full_name,
            'address' => $this->address,
            'province' => $this->province,
            'regency' => $this->regency,
            'subdistrict' => $this->subdistrict,
            'village' => $this->village,
            'number_phone' => $this->number_phone,
            'email' => $this->email,
            'innovation_title' => $this->innovation_title,
            'competition_category' => $this->category_competition,
            'participant_category' => $this->participant_category,
            'abstract' => $this->abstract,
            'innovation_excellence' => $this->innovation_excellence,
            'benefits_of_innovation' => $this->benefits_of_innovation,
            'applications_to_society' => $this->applications_to_society,
            'link_video_innovation' => $this->link_video_innovation,
        ];

        // session(['draft' => $draft]);

        FormKrenovaDraft::updateOrCreate(
            ['user_id' => User::find('1')->id],
            $draft
        );
    }

    // previous step
    public function previousStep()
    {
        $this->currentStep--;
    }

    // form step 1
    public function stepOne()
    {
        // form data diri
        $validateData = $this->validate([
            'full_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'number_phone' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
        ]);

        $this->currentStep = 2;
    }

    // form step 2
    public function stepTwo()
    {
        $validateData = $this->validate([
            'innovation_title' => 'required',
            'category_competition' => 'required'
        ]);

        $this->currentStep = 3;
    }

    // form step 3
    public function stepThree()
    {
        $validateData = $this->validate([
            'participant_category' => 'required',
            'abstract' => 'required',
            'innovation_excellence' => 'required',
            'benefits_of_innovation' => 'required',
            'applications_to_society' => 'required',
            'link_video_innovation' => 'nullable'
        ]);

        $this->currentStep = 4;
    }

    // form step submit
    public function submit()
    {
        // Validasi input file
        $this->validate([
            'surat_pernyataan' => 'required|mimes:pdf|max:10240',
            'fotokopi_identitas' => 'required|mimes:pdf|max:10240',
            'proposal_lomba' => 'required|mimes:pdf|max:10240',
        ]);

        // Buat user (atau ambil jika sudah ada)
        $user = User::find('1');

        $user->update([
            'address' => $this->address,
            'province' => $this->province,
            'regency' => $this->regency,
            'subdistrict' => $this->subdistrict,
            'village' => $this->village
        ]);

        $formKrenova = $user->hasFormKrenova()->create([
            'user_id' => '1',
            'innovation_title' => $this->innovation_title,
            'competition_category' => $this->category_competition,
            'participant_category' => $this->participant_category,
            'abstract' => $this->abstract,
            'innovation_excellence' => $this->innovation_excellence,
            'benefits_of_innovation' => $this->benefits_of_innovation,
            'applications_to_society' => $this->applications_to_society,
            'link_video_innovation' => $this->link_video_innovation,
            'information' => ''
        ]);

        // Tambahkan media ke FormKrenova
        if ($this->surat_pernyataan) {
            $formKrenova->addMedia($this->surat_pernyataan->getRealPath())
                ->toMediaCollection('surat_pernyataan');
        }

        if ($this->fotokopi_identitas) {
            $formKrenova->addMedia($this->fotokopi_identitas->getRealPath())
                ->toMediaCollection('fotokopi_identitas');
        }

        if ($this->proposal_lomba) {
            $formKrenova->addMedia($this->proposal_lomba->getRealPath())
                ->toMediaCollection('proposal_lomba');
        }

        FormKrenovaDraft::where('user_id', '1')->delete();

        // Flash message dan redirect
        session()->flash('message', 'Form berhasil disubmit!');
        return redirect()->route('peserta.krenova.daftar-inovasi');
    }

    public function downloadSurat()
    {
        $templateProcessor = new TemplateProcessor('template_pernyataan.docx');

        // dd($this->regences);

        $nama_kota = '';

        if (!is_null($this->regences)) {
            foreach ($this->regences['data'] as $regency) {
                // dd($regency);
                // $nama_kota = $this->regency == $regency['code'] ? $regency['name'] : '';
                if ($regency['code'] == $this->regency) {
                    $nama_kota = $regency['name'];
                }
            }
            // dd($nama_kota);
        }

        $templateProcessor->setValues([
            'fullname' => $this->full_name,
            'address' => $this->address,
            'regency' => $nama_kota,
            'email' => $this->email,
            'number_phone' => $this->number_phone,
            'innovation_title' => ucfirst($this->innovation_title),
            'category_competition' => ucfirst($this->category_competition),
            'year' => Carbon::parse(now())->format('Y'),
            'date' => Carbon::parse(now())->translatedFormat('d F Y'),
        ]);

        $directory = storage_path('app/public/surat');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // Membuat folder surat jika belum ada
        }

        $filepath = storage_path('app/public/surat/surat_pernyataan_' . $this->full_name . '_' . rand(0000000, 9999999) . '.docx');
        $templateProcessor->saveAs($filepath);
        return response()->download($filepath);
    }

    // render view
    public function render()
    {
        return view('livewire.krenova-form', [
            'provinces' => $this->provinces,
            'regences' => $this->regences,
            'subdistricts' => $this->subdistricts,
        ]);
    }
}
