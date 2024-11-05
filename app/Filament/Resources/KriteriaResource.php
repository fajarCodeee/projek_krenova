<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Kriteria;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\IndikatorOPD;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Resources\KriteriaResource\Pages;


class KriteriaResource extends Resource
{
    protected static ?string $model = IndikatorOPD::class;
    protected static ?string $modelLabel = "Pengaturan Indikator OPD";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pengaturan Surprise';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('indikator')
                    ->label('Indikator')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bobot')
                    ->label('Bobot')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('definisi_operasional')
                    ->label('Definisi Operasional')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('hasParamater')
                    ->label('Paramater')
                    ->relationship('hasParamater')
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\TextInput::make('paramater')
                            ->label('Isi Parameter')
                            ->required(),
                        Forms\Components\TextInput::make('parameter_ke')
                            ->label('Point Parameter')
                            ->numeric()
                            ->required(),
                    ])
                    ->minItems(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
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
                Tables\Columns\TextColumn::make('indikator')
                    ->label('Indikator')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('definisi_operasional')
                    ->label('Definisi Operasional')
                    ->wrap(),
                Tables\Columns\TextColumn::make('bobot')
                    ->label('Bobot')
                    ->sortable(),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKriterias::route('/'),
        ];
    }
}
