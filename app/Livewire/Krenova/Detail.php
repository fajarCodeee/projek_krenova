<?php

namespace App\Livewire\Krenova;

use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\FormKrenova;
use Livewire\WithFileUploads;
use App\Models\FormKrenovaDraft;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class Detail extends Component
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

    public $form_id = null;

    public function mount()
    {
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

        if (!is_null($this->form_id)) {
            $form = FormKrenova::with('user')->where('id', $this->form_id)->first();
            $this->innovation_title = $form->innovation_title;
            $this->category_competition = $form->competition_category;
            $this->participant_category = $form->participant_category;
            $this->abstract = $form->abstract;
            $this->innovation_excellence = $form->innovation_excellence;
            $this->benefits_of_innovation = $form->benefits_of_innovation;
            $this->applications_to_society = $form->applications_to_society;
            $this->link_video_innovation = $form->link_video_innovation;

            $this->surat_pernyataan = $form->getFirstMediaUrl('surat_pernyataan');
            $this->fotokopi_identitas = $form->getFirstMediaUrl('fotokopi_identitas');
            $this->proposal_lomba = $form->getFirstMediaUrl('proposal_lomba');
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

    // previous step
    public function previousStep()
    {
        $this->currentStep--;
    }

    // form step 1
    public function stepOne()
    {
        $this->currentStep = 2;
    }

    // form step 2
    public function stepTwo()
    {
        $this->currentStep = 3;
    }

    // form step 3
    public function stepThree()
    {
        $this->currentStep = 4;
    }

    // render view
    public function render()
    {
        return view('livewire.krenova.detail', [
            'provinces' => $this->provinces,
            'regences' => $this->regences,
            'subdistricts' => $this->subdistricts,
        ]);
    }
}
