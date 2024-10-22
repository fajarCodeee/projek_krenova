<?php

namespace App\Filament\Resources\InovasiPerangkatDaerahResource\Pages;

use App\Filament\Resources\InovasiPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInovasiPerangkatDaerahs extends ListRecords
{
    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
