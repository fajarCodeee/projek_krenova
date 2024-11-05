<?php

namespace App\Filament\Resources\KriteriaResource\Pages;

use App\Filament\Resources\KriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKriterias extends ManageRecords
{
    protected static string $resource = KriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false),
        ];
    }
}
