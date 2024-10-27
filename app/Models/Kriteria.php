<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    public function hasKriteriaOptions()
    {
        return $this->hasMany(KriteriaOption::class);
    }

    public function hasEvaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }
}
