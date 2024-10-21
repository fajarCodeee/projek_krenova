<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormPenelitianDaerahResource\Pages;
use App\Filament\Resources\FormPenelitianDaerahResource\RelationManagers;
use App\Models\FormPenelitianDaerah;
use App\Models\Wilayah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormPenelitianDaerahResource extends Resource
{
    protected static ?string $model = FormPenelitianDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'List Penelitian';
    protected static ?string $navigationGroup = 'Proposal Penelitian';
    protected static ?string $modelLabel = 'List Proposal Penelitian';
    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'fullname')
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('research_title')
                    ->label('Judul Penelitian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('research_location')
                    ->label('Lokasi Penelitian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('institution')
                    ->label('Nama Institusi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('abstraction')
                    ->label('Abstraksi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('province')
                    ->label('Provinsi')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [2])
                            ->pluck('nama', 'kode');
                    })
                    ->disabled()
                    ->default('33')
                    ->required(),
                Forms\Components\Select::make('regency')
                    ->label('Kabupaten')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [5])
                            ->where('kode', '33.06')
                            ->pluck('nama', 'kode');
                    })
                    ->disabled()
                    ->default('33.06')
                    ->required(),
                Forms\Components\Select::make('subdistrict')
                    ->label('Kecamatan')
                    ->options(function () {
                        return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [8])
                            ->where('kode', 'LIKE',  '%33.06%')
                            ->pluck('nama', 'kode');
                    })
                    ->native(false)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('village')
                    ->label('Kelurahan')
                    ->options(function (callable $get) {
                        $subdistrictCode = $get('subdistrict'); // Ambil kecamatan yang dipilih

                        if ($subdistrictCode) {
                            return Wilayah::whereRaw('CHAR_LENGTH(kode) = ?', [13])
                                ->where('kode', 'LIKE',  $subdistrictCode . '%') // Filter kelurahan berdasarkan kode kecamatan
                                ->pluck('nama', 'kode');
                        }

                        return [
                            'Pilih Kecamatan'
                        ]; // Jika belum ada kecamatan yang dipilih, return array kosong
                    })
                    ->native(false)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        '1' => 'Menunggu Konfirmasi',
                        '2' => 'Diterima',
                        '3' => 'Ditolak (Meminta Revisi)',
                    ])
                    ->default('1')
                    ->disabled()
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('information')
                    ->label('Keterangan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn(FormPenelitianDaerah $query) => $query->where('status', '2')->orWhere('status', '3'))
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
                    ->dateTime('d F Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Lihat Detail')
                    ->label('Detail')
                    ->color('warning')
                    ->icon('heroicon-o-eye'),
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
            'index' => Pages\ListFormPenelitianDaerahs::route('/'),
            'create' => Pages\CreateFormPenelitianDaerah::route('/create'),
            'edit' => Pages\EditFormPenelitianDaerah::route('/{record}/edit'),
        ];
    }
}
