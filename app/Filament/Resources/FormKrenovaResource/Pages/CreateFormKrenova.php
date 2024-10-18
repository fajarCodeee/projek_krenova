<?php

namespace App\Filament\Resources\FormKrenovaResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\FormKrenovaResource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CreateFormKrenova extends CreateRecord
{
    protected static string $resource = FormKrenovaResource::class;

    public function form(Form $form): Form
    {
        // dd($form);
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'fullname')
                    ->required()
                    ->native(false),
                TextInput::make('innovation_title')
                    ->label('Judul Inovasi')
                    ->required()
                    ->maxLength(255),
                Select::make('competition_category')
                    ->label('Kategori Lomba')
                    ->required()
                    ->options([
                        'energi' => 'Energi dan Rekayasa Teknologi Manufaktur',
                        'kelautan-perikanan' => 'Industri Kreatif',
                        'kesehatan' => 'Kesehatan',
                        'pendidikan' => 'Pendidikan',
                        'kehutanan' => 'Pertanian dan Pangan',
                        'teknologi-komunikasi' => 'Teknologi Infomasi dan Komunikasi',
                    ])
                    ->native(false),
                Select::make('participant_category')
                    ->label('Kategori Peserta')
                    ->required()
                    ->options([
                        'umum' => 'Masyarakat Umum',
                        'mahasiswa' => 'Pelajar/Mahasiswa/Dosen/Guru/PNS/TNI/Polri',
                    ])
                    ->native(false),
                Textarea::make('abstract')
                    ->label('Abstrak')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('innovation_excellence')
                    ->label('Keunggulan Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('benefits_of_innovation')
                    ->label('Manfaat Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('applications_to_society')
                    ->label('Penerapan Pada Masyarakat')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('link_video_innovation')
                    ->label('Tautan Video')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        '1' => 'Menunggu Konfirmasi',
                        '2' => 'Diterima',
                        '3' => 'Ditolak (Meminta Revisi)',
                    ])
                    ->default('1')
                    ->disabled()
                    ->native(false)
                    ->required(),
                Textarea::make('information')
                    ->label('Keterangan')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('surat_pernyataan')
                    ->label('Upload Surat Pernyataan')
                    ->acceptedFileTypes(['application/pdf'])
                    ->multiple(false)
                    ->collection('surat_pernyataan'),
                SpatieMediaLibraryFileUpload::make('fotokopi_identitas')
                    ->label('Upload Fotokopi Identitas')
                    ->acceptedFileTypes(['application/pdf'])
                    ->multiple(false)
                    ->collection('fotokopi_identitas'),
                SpatieMediaLibraryFileUpload::make('proposal_lomba')
                    ->label('Upload Proposal Lomba')
                    ->acceptedFileTypes(['application/pdf'])
                    ->multiple(false)
                    ->collection('proposal_lomba'),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
