<?php

namespace App\Filament\Resources\KrenovaResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\KrenovaResource;

class EditKrenova extends EditRecord
{
    protected static string $resource = KrenovaResource::class;

    protected static ?string $title = "Detail Krenova";


    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->disabled()
            ->hidden();
    }

    public function form(Form $form): Form
    {
        // dd($form);
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'fullname')
                    ->required()
                    ->disabled()
                    ->native(false),
                TextInput::make('innovation_title')
                    ->label('Judul Inovasi')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                TextInput::make('competition_category')
                    ->label('Kategori Lomba')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                TextInput::make('participant_category')
                    ->label('Kategori Peserta')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                Textarea::make('abstract')
                    ->label('Abstrak')
                    ->required()
                    ->columnSpanFull()
                    ->readOnly(),
                Textarea::make('innovation_excellence')
                    ->label('Keunggulan Inovasi')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull(),
                Textarea::make('benefits_of_innovation')
                    ->label('Manfaat Inovasi')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull(),
                Textarea::make('applications_to_society')
                    ->label('Penerapan Pada Masyarakat')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull(),
                TextInput::make('link_video_innovation')
                    ->label('Tautan Video')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                Select::make('status')
                    ->options([
                        '1' => 'Menunggu Konfirmasi',
                        '2' => 'Diterima',
                        '3' => 'Ditolak (Meminta Revisi)',
                    ])
                    ->native(false)
                    ->required()
                    ->disabled(),
                Textarea::make('information')
                    ->label('Keterangan')
                    ->disabled()
                    ->columnSpanFull(),
                ViewField::make('pdf_preview')
                    ->label('Preview Surat Pernyataan')
                    ->view('components.preview.surat-pernyataan', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),
                ViewField::make('pdf_preview')
                    ->label('Preview Identitas')
                    ->view('components.preview.fotokopi-identitas', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),
                ViewField::make('pdf_preview')
                    ->label('Preview Proposal Lomba')
                    ->view('components.preview.proposal-lomba', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),
            ]);
    }
}
