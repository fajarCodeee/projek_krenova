<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FormKrenova extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
