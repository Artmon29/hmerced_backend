<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CitaP;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombres',
        'apellidos',
        'direccion',
        'rfid',
        'user_id'
    ];
    public function citas():HasMany
    {
        return $this->hasMany(CitaP::class,'paciente_id');
    }

}
