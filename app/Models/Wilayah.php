<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{

    protected $table = 'wilayah';

    use HasFactory;

    public function getProvinceName()
    {
        return $this->whereRaw('CHAR_LENGTH(kode) = ?', [2])->get();
    }

    public function getRegencyName($province_code = '')
    {
        return $this->whereRaw('CHAR_LENGTH(kode) = ?', [5])
            ->where('kode', 'LIKE', $province_code . '%')
            ->get();
    }

    public function getSubdistrictName($regency_code = '')
    {
        return $this->whereRaw('CHAR_LENGTH(kode) = ?', [8])
            ->where('kode', 'LIKE', $regency_code . '%')
            ->get();
    }

    public function getVillageName($subdistrict_code = '')
    {
        return $this->where('kode', 'LIKE', $subdistrict_code . '%')
            ->get();
    }
}
