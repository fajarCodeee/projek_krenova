<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use Livewire\Livewire;
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
    protected $form_id;

    public function mount($record): void
    {
        $this->form_id = $record;
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
                \App\Models\IndikatorOPD::query()->with('hasEvaluasi')
            )
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->state(
                        static function (HasTable $livewire, stdClass $rowLoop): string {
                            return (string) (
                                $rowLoop->iteration +
                                ($livewire->getTableRecordsPerPage() * (
                                    $livewire->getTablePage() - 1
                                ))
                            );
                        }
                    ),
                TextColumn::make('indikator')
                    ->label('Indikator')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('hasEvaluasi.parameterOpd.parameter')
                    ->label('Keterangan')
                    ->default('-')
                    ->wrap(),
                TextColumn::make('hasEvaluasi.point')
                    ->label('Skor')
                    ->default('0'),

            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(fn($record) => route('filament.opd.resources.form-inovasi-perangkat-daerahs.form-indikator', [
                        'record' => $record->id,
                        'form_id' => request()->route('record')
                    ]))
                    ->label('Lihat'),
            ])
            ->paginated(false);
    }
}
