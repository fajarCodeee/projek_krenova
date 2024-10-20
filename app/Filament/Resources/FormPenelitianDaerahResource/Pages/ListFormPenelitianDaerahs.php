<?php

namespace App\Filament\Resources\FormPenelitianDaerahResource\Pages;

use App\Filament\Resources\FormPenelitianDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormPenelitianDaerahs extends ListRecords
{
    protected static string $resource = FormPenelitianDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
