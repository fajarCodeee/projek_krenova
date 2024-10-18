<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\FormKrenova;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Builder;
use App\Filament\Resources\KrenovaResource\Pages;

class KrenovaResource extends Resource
{
    protected static ?string $model = FormKrenova::class;

    protected static ?string $navigationLabel = 'List Krenova';

    protected static ?string $navigationGroup = 'Krenova';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'List Krenova';
    }


    public static function table(Table $table): Table
    {

        return $table
            ->query(fn(FormKrenova $query) => $query->where('status', '2')->orWhere('status', '3'))
            // ->orderBy('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('innovation_title')
                    ->label('Judul Inovasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition_category')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d F Y'),
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

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Lihat Detail')
                    ->label('Detail')
                    ->color('warning')
                    ->icon('heroicon-o-eye'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKrenovas::route('/'),
            'create' => Pages\CreateKrenova::route('/create'),
            'edit' => Pages\EditKrenova::route('/{record}/edit'),
        ];
    }

    // bisa create jika lomba dimulai
    public static function canCreate(): bool
    {
        return false;
    }
}
