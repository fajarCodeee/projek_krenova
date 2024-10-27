<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormInovasiPerangkatDaerah extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('anggaran');
        $this->addMediaCollection('profil_bisnis');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasEvaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }
}
