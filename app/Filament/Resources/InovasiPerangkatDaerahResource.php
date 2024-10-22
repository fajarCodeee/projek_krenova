<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InovasiPerangkatDaerahResource\Pages;
use App\Filament\Resources\InovasiPerangkatDaerahResource\RelationManagers;
use App\Models\FormInovasiPerangkatDaerah;
use App\Models\InovasiPerangkatDaerah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InovasiPerangkatDaerahResource extends Resource
{
    protected static ?string $model = FormInovasiPerangkatDaerah::class;

    protected static ?string $navigationGroup = 'Perangkat Daerah';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Inovasi Perangkat Daerah';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'fullname')
                    ->required()
                    ->disabled()
                    ->native(false),
                Forms\Components\TextInput::make('innovation_name')
                    ->label('Nama Inovasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('stage_of_innovation')
                    ->label('Tahapan Inovasi')
                    ->options([
                        'inisiatif' => 'Inisiatif',
                        'penerapan' => 'Penerapan',
                        'uji-coba' => 'Uji Coba'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('regional_innovation_initiator')
                    ->label('Inisiator Inovasi Daerah')
                    ->options([
                        'kepala' => 'Kepala Daerah',
                        'opd' => 'OPD',
                        'asn' => 'ASN',
                        'masyarakat' => 'Masyarakat',
                        'dprd' => 'Anggota DPRD'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('type_of_innovation')
                    ->label('Jenis Inovasi ')
                    ->options([
                        'digital' => 'Digital',
                        'non-digital' => 'Non Digital'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('forms_of_regional_innovation')
                    ->label('Bentuk Inovasi Daerah')
                    ->options([
                        'tata-kelola' => 'Tata Kelola Pemerintahan Daerah',
                        'pelayanan-publik' => 'Pelayanan Publik',
                        'bentuk-lainnya' => 'Bentuk Lainnya Sesuai Bidang Urusan Pemerintahan Yang Menjadi Kewenangan Daerah'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('thematic')
                    ->label('Tematik')
                    ->options([
                        'digitalisasi-layanan-pemerintahan' => 'Digitalisasi Layanan Pemerintah',
                        'penanggulangan-kemiskinan' => 'Penanggulangan Kemiskinan',
                        'kemudahan-investasi' => 'Kemudahan Investasi',
                        'prioritas-aktual-presiden' => 'Prioritas Aktual Presiden',
                        'non-tematik' => 'Non Tematik',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('trial_time')
                    ->label('Waktu Uji Coba Inovasi Daerah')
                    ->required(),
                Forms\Components\DatePicker::make('implementation_time')
                    ->label('Waktu Penerapan Inovasi Daerah')
                    ->required(),
                Forms\Components\Textarea::make('plan_wake')
                    ->label('Rancang Bangun')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('goals')
                    ->label('Tujuan Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('benefits')
                    ->label('Manfaat yang diperoleh')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('result')
                    ->label('Hasil Inovasi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('anggaran')
                    ->label('Anggaran (jika ada)')
                    ->collection('anggaran')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\SpatieMediaLibraryFileUpload::make('profil-bisnis')
                    ->label('Profil Bisnis (jika ada)')
                    ->collection('profil-bisnis')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\ViewField::make('pdf_preview')
                    ->label('Preview Anggaran')
                    ->view('components.preview.anggaran', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),
                Forms\Components\ViewField::make('pdf_preview')
                    ->label('Preview Profil Bisnis')
                    ->view('components.preview.profile-bisnis', [
                        'model' => $form->getModel(),
                        'id' => $form->model->id,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Nama Lengkap')
                    ->searchable(),
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
            'index' => Pages\ListInovasiPerangkatDaerahs::route('/'),
            'create' => Pages\CreateInovasiPerangkatDaerah::route('/create'),
            'edit' => Pages\EditInovasiPerangkatDaerah::route('/{record}/edit'),
        ];
    }
}