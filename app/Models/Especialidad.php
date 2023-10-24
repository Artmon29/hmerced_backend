<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CitaP;
use App\Models\Medico;
class Especialidad extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombres',
        'descripcion'
    ];
    public function citas(): HasMany
    {
        return $this->hasMany(CitaP::class,'especialidad_id');
    }
    //
    public function medicos(): HasMany
    {
        return $this->hasMany(Medico::class);
    }

}
