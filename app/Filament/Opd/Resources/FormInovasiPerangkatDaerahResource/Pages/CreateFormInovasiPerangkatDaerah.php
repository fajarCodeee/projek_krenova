<?php

namespace App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource\Pages;


use Exception;
use App\Models\Evaluasi;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Opd\Resources\FormInovasiPerangkatDaerahResource;

class CreateFormInovasiPerangkatDaerah extends CreateRecord
{
    protected static string $resource = FormInovasiPerangkatDaerahResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
