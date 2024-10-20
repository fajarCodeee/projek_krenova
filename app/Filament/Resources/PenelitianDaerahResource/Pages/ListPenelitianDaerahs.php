<?php

namespace App\Filament\Resources\PenelitianDaerahResource\Pages;

use App\Filament\Resources\PenelitianDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenelitianDaerahs extends ListRecords
{
    protected static string $resource = PenelitianDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
