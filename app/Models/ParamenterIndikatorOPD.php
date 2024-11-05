<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamenterIndikatorOPD extends Model
{
    use HasFactory;
    protected $table = 'tb_parameter_indikator_opd';
    protected $guarded = ['id'];

    public function indikator()
    {
        return $this->belongsTo(IndikatorOPD::class, 'indikator_id');
    }
}
