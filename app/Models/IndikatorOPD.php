<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorOPD extends Model
{
    use HasFactory;
    protected $table = 'tb_indikator_opd';
    protected $guarded =  ['id'];

    public function hasParamater()
    {
        return $this->hasMany(ParamenterIndikatorOPD::class, 'indikator_id', 'id');
    }

    public function hasEvaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'indikator_id');
    }
}
