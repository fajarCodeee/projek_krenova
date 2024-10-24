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

    protected function handleRecordCreation(array $data): Model
    {
        $kriteria = Kriteria::with('hasKriteriaOptions')->get();

        // Cek apakah kriteria tidak kosong
        if ($kriteria->isEmpty()) {
            // Jika kriteria kosong, batalkan pembuatan data dan beri log atau pesan kesalahan
            Log::warning('Tidak ada data kriteria. Pembuatan form dibatalkan.');
            return null;
        }

        foreach ($kriteria as $k) {
            // Cek apakah ada opsi yang terkait dengan kriteria ini
            if ($k->hasKriteriaOptions->isEmpty()) {
                // Jika tidak ada opsi terkait, batalkan pembuatan data dan beri log atau pesan kesalahan
                Log::warning("Kriteria ID {$k->id} tidak memiliki opsi terkait. Pembuatan form dibatalkan.");
                return null;
            }
        }

        $create = static::getModel()::create($data);

        if ($create) {
            try {
                // Loop lagi untuk menyimpan data evaluasi
                foreach ($kriteria as $k) {
                    foreach ($k->hasKriteriaOptions as $option) {
                        // Buat entri evaluasi untuk setiap opsi terkait
                        Evaluasi::create([
                            'user_id' => Auth::user()->id,
                            'form_id' => $create->id,
                            'kriteria_id' => $k->id,
                            'kriteria_option_id' => $option->id,
                        ]);
                    }
                }
            } catch (Exception $e) {
                // Tangkap kesalahan dan log pesan error
                Log::error('Error saat membuat evaluasi: ' . $e->getMessage());

                // Jika terjadi error, Anda bisa melempar exception atau mengembalikan pesan kesalahan
                throw new Exception("Terjadi kesalahan saat menyimpan data evaluasi.");
            }
        }
        return $create;
    }
}
