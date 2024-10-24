<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use Filament\Forms;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\FormInovasiPerangkatDaerah;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;

class Indikator extends Page implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;

    protected $record;
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;
    protected static string $view = 'filament.opd.resources.form-inovasi-perangkat-daerah-resource.pages.indikator';


    public function mount($record): void
    {
        // Ambil model berdasarkan ID yang dikirim dari index
        $this->record = FormInovasiPerangkatDaerah::findOrFail($record);
    }

    public function getTitle(): string
    {
        // Title dinamis berdasarkan nama inovasi dari record
        return 'Detail (' . $this->record->innovation_name . ')';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
            ])
            ->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(FormInovasiPerangkatDaerah::query())
            ->columns([
                // ...
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
