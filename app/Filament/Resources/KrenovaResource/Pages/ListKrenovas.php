<?php

namespace App\Filament\Resources\KrenovaResource\Pages;

use App\Filament\Resources\FormKrenovaResource;
use App\Filament\Resources\KrenovaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKrenovas extends ListRecords
{
    protected static string $resource = KrenovaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(fn() => FormKrenovaResource::getUrl('create')),
        ];
    }
}
