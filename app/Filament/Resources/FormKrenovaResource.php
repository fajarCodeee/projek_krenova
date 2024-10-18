<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FormKrenova;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\RestoreAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormKrenovaResource\Pages;
use App\Filament\Resources\FormKrenovaResource\RelationManagers;

class FormKrenovaResource extends Resource
{
    protected static ?string $model = FormKrenova::class;

    protected static ?string $navigationLabel = 'Menunggu Konfirmasi';

    protected static ?string $navigationGroup = 'Krenova';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Menunggu Konfirmasi';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {

        return $table
            ->query(fn(FormKrenova $query) => $query->where('status', '1'))
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('innovation_title')
                    ->label('Judul Inovasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition_category')
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('link_video_innovation')
                    ->label('Link Video'),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        if ($state === '1') {
                            return 'Menunggu Konfimasi';
                        } elseif ($state === '2') {
                            return 'Disetujui';
                        } elseif ($state === '3') {
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
                Tables\Actions\EditAction::make('show')
                    ->label('Detail')
                    ->tooltip('Lihat Detail')
                    ->icon('heroicon-o-eye'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormKrenovas::route('/'),
            'create' => Pages\CreateFormKrenova::route('/create'),
            'edit' => Pages\EditFormKrenova::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
