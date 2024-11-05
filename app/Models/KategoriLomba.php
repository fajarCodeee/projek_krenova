<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLomba extends Model
{
    use HasFactory;
    protected $table = 'kategori_lomba';
    protected $guarded = ['id'];

    const STATUS_AKTIF = 'aktif';
    const STATUS_NONAKTIF = 'non-aktif';

    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_NONAKTIF => 'Non-aktif',
        ];
    }
}
