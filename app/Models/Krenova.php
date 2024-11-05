<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krenova extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'krenova';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('surat_pernyataan');
        $this->addMediaCollection('fotokopi_identitas');
        $this->addMediaCollection('proposal_lomba');
    }
}
