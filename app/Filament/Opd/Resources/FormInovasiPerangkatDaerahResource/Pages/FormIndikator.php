<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;



class FormIndikator extends Page
{
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;
    protected static string $view = 'filament.opd.resources.form-inovasi-perangkat-daerah-resource.pages.form-indikator';
    protected $record;

    public function mount($record)
    {
        $this->record = \App\Models\Kriteria::with('hasKriteriaOptions')->findOrFail($record);
    }

    public function getTitle(): String
    {
        return $this->record->name;
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Radio::make('kriteria_option_id')
                ->label($this->record->name)
                ->options(\App\Models\KriteriaOption::where('kriteria_id', $this->record->id)
                    ->pluck('option_text', 'id')
                    ->toArray()
                )
                ->required(),
        ]);
    }
}
