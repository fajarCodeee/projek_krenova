<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluasi extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function form()
    {
        return $this->belongsTo(FormInovasiPerangkatDaerah::class, 'form_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function kriteria_option()
    {
        return $this->belongsTo(KriteriaOption::class, 'kriteria_option_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen_pendukung');
    }
}
