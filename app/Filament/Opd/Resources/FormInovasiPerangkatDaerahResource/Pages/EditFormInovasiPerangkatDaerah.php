<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use Filament\Forms;
use Filament\Actions;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;

class EditFormInovasiPerangkatDaerah extends EditRecord
{
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id)
                    ->required(),
                Forms\Components\TextInput::make('innovation_name')
                    ->label('Nama Inovasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('stage_of_innovation')
                    ->label('Tahapan Inovasi')
                    ->options([
                        'inisiatif' => 'Inisiatif',
                        'penerapan' => 'Penerapan',
                        'uji-coba' => 'Uji Coba'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('regional_innovation_initiator')
                    ->label('Inisiator Inovasi Daerah')
                    ->options([
                        'kepala' => 'Kepala Daerah',
                        'opd' => 'OPD',
                        'asn' => 'ASN',
                        'masyarakat' => 'Masyarakat',
                        'dprd' => 'Anggota DPRD'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('type_of_innovation')
                    ->label('Jenis Inovasi ')
                    ->options([
                        'digital' => 'Digital',
                        'non-digital' => 'Non Digital'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('forms_of_regional_innovation')
                    ->label('Bentuk Inovasi Daerah')
                    ->options([
                        'tata-kelola' => 'Tata Kelola Pemerintahan Daerah',
                        'pelayanan-publik' => 'Pelayanan Publik',
                        'bentuk-lainnya' => 'Bentuk Lainnya Sesuai Bidang Urusan Pemerintahan Yang Menjadi Kewenangan Daerah'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('thematic')
                    ->label('Tematik')
                    ->options([
                        'digitalisasi-layanan-pemerintahan' => 'Digitalisasi Layanan Pemerintah',
                        'penanggulangan-kemiskinan' => 'Penanggulangan Kemiskinan',
                        'kemudahan-investasi' => 'Kemudahan Investasi',
                        'prioritas-aktual-presiden' => 'Prioritas Aktual Presiden',
                        'non-tematik' => 'Non Tematik',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('trial_time')
                    ->label('Waktu Uji Coba Inovasi Daerah')
                    ->required(),
                Forms\Components\DatePicker::make('implementation_time')
                    ->label('Waktu Penerapan Inovasi Daerah')
                    ->required(),
                Forms\Components\Textarea::make('plan_wake')
                    ->label('Rancang Bangun')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('goals')
                    ->label('Tujuan Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('benefits')
                    ->label('Manfaat yang diperoleh')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('result')
                    ->label('Hasil Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('anggaran')
                    ->label('Anggaran (jika ada)')
                    ->collection('anggaran')
                    ->acceptedFileTypes(['application/pdf'])
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('profil-bisnis')
                    ->label('Profil Bisnis (jika ada)')
                    ->collection('profil-bisnis')
                    ->acceptedFileTypes(['application/pdf'])
                    ->columnSpanFull(),
            ]);
    }
}
