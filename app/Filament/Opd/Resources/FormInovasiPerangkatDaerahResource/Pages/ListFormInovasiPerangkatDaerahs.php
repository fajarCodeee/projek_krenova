<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;

use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormInovasiPerangkatDaerahs extends ListRecords
{
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data'),
        ];
    }
}
