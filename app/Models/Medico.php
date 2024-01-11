<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CitaP;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medico extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombres',
        'apellidos',
        'direccion',
        'email',
        'telefono',
        'turno',
        'especialidad_id',
        'user_id'
    ];
    public function citas(): HasMany
    {
        return $this->hasMany(CitaP::class,'medico_id');
    }
    //
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    //
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
