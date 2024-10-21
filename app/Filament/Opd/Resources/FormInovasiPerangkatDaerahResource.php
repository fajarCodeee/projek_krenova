<?php

namespace App\Filament\Opd\Resources;

use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\RelationManagers;
use App\Models\FormInovasiPerangkatDaerah;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class FormInovasiPerangkatDaerahResource extends Resource
{
    protected static ?string $model = FormInovasiPerangkatDaerah::class;
    protected static ?string $modelLabel = 'Inovasi Perangkat Daerah';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('innovation_name')
                    ->label('Nama Inovasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stage_of_innovation')
                    ->label('Tahapan Inovasi')
                    ->formatStateUsing(function ($state) {
                        if ($state == 'uji-coba') {
                            return 'Uji Coba';
                        } else if ($state == 'penerapan') {
                            return 'Penerapan';
                        } else if ($state == 'inisiatif') {
                            return 'Inisiatif';
                        }
                    }),
                Tables\Columns\TextColumn::make('forms_of_regional_innovation')
                    ->label('Bentuk Inovasi Daerah'),
                Tables\Columns\TextColumn::make('trial_time')
                    ->label('Waktu Uji Coba')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('implementation_time')
                    ->label('Waktu Penerapan Hasil')
                    ->date('d F Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Detail'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormInovasiPerangkatDaerahs::route('/'),
            'create' => Pages\CreateFormInovasiPerangkatDaerah::route('/create'),
            'edit' => Pages\EditFormInovasiPerangkatDaerah::route('/{record}/edit'),
        ];
    }
}
