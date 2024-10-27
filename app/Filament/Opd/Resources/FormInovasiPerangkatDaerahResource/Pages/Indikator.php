<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use App\Models\Evaluasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Models\FormInovasiPerangkatDaerah;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;

class Indikator extends Page implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;

    protected static string $model = Evaluasi::class;

    protected $record;
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;
    protected static string $view = 'filament.opd.resources.form-inovasi-perangkat-daerah-resource.pages.indikator';


    public function mount($record): void
    {
        $this->record = FormInovasiPerangkatDaerah::findOrFail($record);
    }

    public function getTitle(): string
    {
        return 'Detail (' . $this->record->innovation_name . ')';
    }


    public static function table(Table $table): Table
    {
        return $table
        ->query(
            \App\Models\Kriteria::query()->with('hasEvaluasi')
        )
        ->columns([
            TextColumn::make('name')
                ->label('Indikator'),
            TextColumn::make('hasEvaluasi.kriteria_option.option_text')
                ->label('Keterangan')
                ->default('-'),
            TextColumn::make('skor')
                ->label('Skor')
                ->default('0'),

        ])
        ->actions([
            Tables\Actions\Action::make('edit')
                ->url(fn ($record) => route('filament.opd.resources.form-inovasi-perangkat-daerahs.form-indikator', $record->id))
                ->label('Lihat'),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

}
