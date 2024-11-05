<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'number_phone',
        'address',
        'province',
        'regency',
        'subdistrict',
        'village'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasFormKrenova()
    {
        return $this->hasMany(FormKrenova::class);
    }

    public function hasKrenova()
    {
        return $this->hasMany(Krenova::class);
    }

    public function hasFormKrenovaDraft()
    {
        return $this->hasMany(FormKrenovaDraft::class);
    }

    public function hasFormPenelitianDaerah()
    {
        return $this->hasMany(FormPenelitianDaerah::class);
    }

    public function hasFormPenelitianDaerahDraft()
    {
        return $this->hasMany(FormPenelitianDaerahDraft::class);
    }

    public function hasFormInovasiPerangkatDaerah()
    {
        return $this->hasMany(FormInovasiPerangkatDaerah::class);
    }

    public function hasEvaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }
}
