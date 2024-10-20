<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenelitianDaerahResource\Pages;
use App\Filament\Resources\PenelitianDaerahResource\RelationManagers;
use App\Models\FormPenelitianDaerah;
use AppModelsFormPenelitianDaerah\PenelitianDaerah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenelitianDaerahResource extends Resource
{
    protected static ?string $model = FormPenelitianDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Menunggu Konfirmasi';

    protected static ?string $navigationGroup = 'Proposal Penelitian';

    protected static ?string $modelLabel = 'Menunggu Konfirmasi';

    protected static ?int $navigationSort = 4;

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn(FormPenelitianDaerah $query) => $query->where('status', '1'))
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('research_title')
                    ->label('Judul Penelitian'),
                Tables\Columns\TextColumn::make('institution')
                    ->label('Institusi'),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        if ($state == '1') {
                            return 'Menunggu Konfimasi';
                        } elseif ($state == '2') {
                            return 'Disetujui';
                        } elseif ($state == '3') {
                            return 'Ditolak';
                        }
                        return 'Tidak Diketahui';
                    })->color(function ($state) {
                        return match ($state) {
                            '1' => 'warning',
                            '2' => 'success',
                            '3' => 'danger',
                            default => 'gray',
                        };
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->since()
                    ->dateTimeTooltip('d F Y'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenelitianDaerahs::route('/'),
            'create' => Pages\CreatePenelitianDaerah::route('/create'),
            'edit' => Pages\EditPenelitianDaerah::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
