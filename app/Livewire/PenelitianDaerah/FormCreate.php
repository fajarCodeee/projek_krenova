<?php

namespace App\Livewire\PenelitianDaerah;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Wilayah;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCreate extends Component
{

    use WithFileUploads;

    public $title_page = null;
    public $full_name, $address, $subdistrict, $village, $number_phone, $email, $province = '33', $regency = '33.06';
    public $research_title, $research_location, $institution, $abstraction;
    public $proposal_penelitian;

    public $provinces = [];
    public $regences = null, $subdistricts = null, $villages = null;
    public $form_id = null;

    public $is_edit = false;

    public function render()
    {
        return view('livewire.penelitian-daerah.form-create');
    }

    public function mount()
    {
        $user = User::find('1');

        if ($this->province != null) {
            $this->loadRegencyName($this->province);
        }

        if ($this->regency != null) {
            $this->loadSubdistrictName($this->regency);
        }

        $this->loadProfile();
        $this->getProvinceName();

        if (!is_null($this->form_id)) {

            $form = $user->hasFormPenelitianDaerah()
                ->where('id', $this->form_id)
                ->first();

            if ($form->status == '3') {
                $this->is_edit = true;
            }

            $this->subdistrict = $form->subdistrict;
            $this->village = $form->village;
            $this->research_title = $form->research_title;
            $this->regency = $form->regency;
            $this->institution = $form->institution;
            $this->abstraction = $form->abstraction;
            $this->address = $form->address;

            $this->proposal_penelitian = $form->getFirstMediaUrl('proposal_penelitian');

            if ($this->subdistrict) {
                $this->loadVillageName($this->subdistrict);
            }
        } else {
            $this->is_edit = true;
        }
    }

    // load user profil
    public function loadProfile()
    {
        $user = User::find('1');

        $this->full_name = $user->fullname ?? '';
        $this->number_phone = $user->number_phone ?? '';
        $this->email = $user->email ?? '';
    }

    public function getProvinceName()
    {
        $locations = new Wilayah();
        return $this->provinces = json_decode($locations->getProvinceName(), true);
    }

    public function loadRegencyName($prov_code)
    {
        $locations = new Wilayah();
        return $this->regences = json_decode($locations->getRegencyName($prov_code), true);
    }

    public function loadSubdistrictName($regency_code)
    {
        $locations = new Wilayah();
        return $this->subdistricts = json_decode($locations->getSubdistrictName($regency_code), true);
    }

    public function loadVillageName($subdistrict_code)
    {
        $locations = new Wilayah();
        return $this->villages = json_decode($locations->getVillageName($subdistrict_code), true);
    }

    public function submit()
    {
        $user = User::find('1');

        $formPenelitian = $user->hasFormPenelitianDaerah()->updateOrCreate(['id' => $this->form_id], [
            'user_id' => $user->id,
            'research_title' => $this->research_title,
            'research_location' => $this->regency,
            'address' => $this->address,
            'institution' => $this->institution,
            'abstraction' => $this->abstraction,
            'province' => $this->province,
            'regency' => $this->regency,
            'subdistrict' => $this->subdistrict,
            'village' => $this->village,
        ]);

        if ($this->proposal_penelitian) {
            $formPenelitian->addMedia($this->proposal_penelitian->getRealPath())
                ->toMediaCollection('proposal_penelitian');
        }

        return redirect()->route('peserta.penelitian.pending.daftar-penelitian-daerah')->with('success', 'Berhasil menambahkan! <b>Menunggu Verifikasi</b>');
    }
}
