<?php

namespace App\Filament\Resources\PenelitianDaerahResource\Pages;

use Filament\Forms;
use Filament\Actions;
use App\Models\Wilayah;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PenelitianDaerahResource;

class EditPenelitianDaerah extends EditRecord
{
    protected static string $resource = PenelitianDaerahResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'fullname')
                    ->required()
                    ->disabled()
                    ->native(false),
                Forms\Components\TextInput::make('research_title')
                    ->label('Judul Penelitian')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('research_location')
                    ->label('Lokasi Penelitian')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('institution')
                    ->label('Nama Institusi')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('abstraction')
                    ->label('Abstraksi')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Select::make('province')
                    ->label('Provinsi')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [2])
                            ->pluck('nama', 'kode');
                    })
                    ->disabled()
                    ->default('33')
                    ->required(),
                Forms\Components\Select::make('regency')
                    ->label('Kabupaten')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [5])
                            ->where('kode', '33.06')
                            ->pluck('nama', 'kode');
                    })
                    ->disabled()
                    ->default('33.06')
                    ->required(),
                Forms\Components\Select::make('subdistrict')
                    ->label('Kecamatan')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [8])
                            ->where('kode', 'LIKE',  '%33.06%')
                            ->pluck('nama', 'kode');
                    })
                    ->native(false)
                    ->disabled()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('village')
                    ->label('Kelurahan')
                    ->options(function (callable $get) {
                        $subdistrictCode = $get('subdistrict'); // Ambil kecamatan yang dipilih

                        if ($subdistrictCode) {
                            return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [13])
                                ->where('kode', 'LIKE',  $subdistrictCode . '%') // Filter kelurahan berdasarkan kode kecamatan
                                ->pluck('nama', 'kode');
                        }

                        return [
                            'Pilih Kecamatan'
                        ]; // Jika belum ada kecamatan yang dipilih, return array kosong
                    })
                    ->native(false)
                    ->searchable()
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        '1' => 'Menunggu Konfirmasi',
                        '2' => 'Diterima',
                        '3' => 'Ditolak (Meminta Revisi)',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('information')
                    ->label('Keterangan')
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\ViewField::make('pdf_preview')
                    ->label('Preview Surat Pernyataan')
                    ->view('components.preview.proposal_penelitian', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),

            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
