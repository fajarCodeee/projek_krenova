<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluasi extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'index_indikator_opd';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorOPD::class, 'indikator_id');
    }

    public function parameterOpd()
    {
        return $this->belongsTo(ParamenterIndikatorOPD::class, 'parameter_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen_pendukung');
    }
}
