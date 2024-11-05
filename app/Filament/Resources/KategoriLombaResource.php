<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\KategoriLomba;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Resources\KategoriLombaResource\Pages;
use App\Filament\Resources\KategoriLombaResource\RelationManagers;

class KategoriLombaResource extends Resource
{
    protected static ?string $model = KategoriLomba::class;
    protected static ?string $navigationGroup = 'Pengaturan Surprise';

    protected static ?int $navigationSort = 8;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori Lomba')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($set, $state) {
                        $set('slug_kategori', Str::slug($state));
                    })
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Hidden::make('slug_kategori'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No. ')
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
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Kategori Lomba')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions(
                [
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ])
                ]
            );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKategoriLombas::route('/'),
        ];
    }
}
