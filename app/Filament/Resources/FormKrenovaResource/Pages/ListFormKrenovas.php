<?php

namespace App\Filament\Resources\FormKrenovaResource\Pages;

use App\Filament\Resources\FormKrenovaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormKrenovas extends ListRecords
{
    protected static string $resource = FormKrenovaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
