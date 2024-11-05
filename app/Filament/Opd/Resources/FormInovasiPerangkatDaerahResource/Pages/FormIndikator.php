<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

// PDF Preview
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class FormIndikator extends Page implements HasForms
{

    use InteractsWithForms;

    protected static string $resource = FormInovasiPerangkatDaerahResource::class;
    protected static string $view = 'filament.opd.resources.form-inovasi-perangkat-daerah-resource.pages.form-indikator';
    public $record, $form_id, $existingEvaluasi;
    public ?array $data = [];


    public function mount($record, $form_id)
    {
        $this->record = \App\Models\IndikatorOPD::with('hasParamater', 'hasEvaluasi')->findOrFail($record);

        // Cek apakah sudah ada evaluasi untuk kriteria ini
        $this->existingEvaluasi = \App\Models\Evaluasi::where([
            'inovasi_id' => $form_id,
            'indikator_id' => $record,
            'user_id' => Auth::user()->id,
        ])->first();

        // dd($existingEvaluasi->getFirstMedia('dokumen_pendukung')->getPath());

        if ($this->existingEvaluasi) {
            try {
                $media = $this->existingEvaluasi->getFirstMedia('dokumen_pendukung');

                if ($media) {
                    $this->form->fill([
                        'parameter_id' => $this->existingEvaluasi->parameter_id,
                        'file' => Storage::url($media->getPath()) // atau getUrl() untuk URL
                    ]);
                } else {
                    // Handle kasus ketika tidak ada media
                    $this->form->fill([
                        'parameter_id' => $this->existingEvaluasi->parameter_id,
                        'file' => null
                    ]);
                }
            } catch (\Exception $e) {
                // Handle error
                logger()->error('Error loading media: ' . $e->getMessage());
                $this->form->fill([
                    'parameter_id' => $this->existingEvaluasi->parameter_id
                ]);
            }
        }

        $this->form_id = $form_id;
    }

    public function getTitle(): String
    {
        return $this->record->indikator;
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data') // Tambahkan ini
            ->schema([
                Forms\Components\Radio::make('parameter_id')
                    ->label(fn() => $this->record->definisi_operasional)
                    ->options(
                        fn() => \App\Models\ParamenterIndikatorOPD::where('indikator_id', $this->record->id)
                            ->pluck('parameter', 'id')
                            ->toArray()
                    )
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->label('Dokumen Pendukung')
                    ->directory('dokumen_pendukung') // Set upload directory
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(20180) // 5MB max size
                    ->required(fn() => $this->existingEvaluasi == null)
                    ->preserveFilenames()
                    ->maxSize(5120)
                    ->helperText('Format file: PDF. Maksimal ukuran: 20MB'),
                Forms\Components\ViewField::make('pdf_preview')
                    ->hidden(fn() => $this->existingEvaluasi == null)
                    ->view('components.preview.dokumen_pendukung', [
                        'model' => $this->existingEvaluasi,
                    ]),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Submit')
                ->submit('save'),
        ];
    }

    public function save()
    {
        $data = $this->form->getState();

        $existingEvaluasi = \App\Models\Evaluasi::with('indikator')->where([
            'inovasi_id' => $this->form_id,
            'indikator_id' => $this->record->id,
            'user_id' => Auth::user()->id,
        ])->first();

        if ($existingEvaluasi) {

            $paramater = \App\Models\ParamenterIndikatorOPD::where('id', $data['parameter_id'])->first();
            $bobot_indikator = $existingEvaluasi->indikator->bobot;

            $point = $paramater->parameter_ke * $bobot_indikator;
            // Update data yang sudah ada
            $existingEvaluasi->update([
                'parameter_id' => $data['parameter_id'],
                'point' => $point,
            ]);

            if (isset($data['file'])) {
                // Hapus file lama jika ada
                $existingEvaluasi->clearMediaCollection('dokumen_pendukung');

                // Upload new file with custom properties
                $existingEvaluasi->addMediaFromDisk($data['file'], 'public')
                    ->usingName(pathinfo($data['file'], PATHINFO_FILENAME))
                    ->usingFileName($data['file'])
                    ->withCustomProperties([
                        'uploaded_by' => Auth::user()->name,
                        'upload_date' => now()->toDateTimeString(),
                    ])
                    ->toMediaCollection('dokumen_pendukung');
            }

            $evaluasi = $existingEvaluasi;
        } else {
            // Buat data baru jika belum ada

            $paramater = \App\Models\ParamenterIndikatorOPD::where('id', $data['parameter_id'])->first()->parameter_ke;
            $indikator = \App\Models\IndikatorOPD::where('id', $this->record->id)->first()->bobot;

            $point = (float) $paramater * $indikator;

            // dd($point);

            $evaluasi = \App\Models\Evaluasi::create([
                'user_id' => Auth::user()->id,
                'inovasi_id' => $this->form_id,
                'indikator_id' => $this->record->id,
                'parameter_id' => $data['parameter_id'],
                'point' => $point,
            ]);

            if (isset($data['file'])) {
                // $evaluasi->addMedia($data['file'])
                //     ->toMediaCollection('dokumen_pendukung');
                $evaluasi->addMediaFromDisk($data['file'], 'public')
                    ->usingName(pathinfo($data['file'], PATHINFO_FILENAME))
                    ->usingFileName($data['file'])
                    ->withCustomProperties([
                        'uploaded_by' => Auth::user()->fullname,
                        'upload_date' => now()->toDateTimeString(),
                    ])
                    ->toMediaCollection('dokumen_pendukung');
            }
        }

        Notification::make()
            ->success()
            ->title($existingEvaluasi ? 'Updated successfully' : 'Saved successfully')
            ->send();

        return redirect()->back();
    }
}
