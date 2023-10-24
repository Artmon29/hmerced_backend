<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especialidad;
use App\Models\Paciente;
use App\Models\Medico;
class CitaP extends Model
{
    use HasFactory;
    protected $fillable=[
        'fecha',
        'hora',
        'especialidad_id',
        'paciente_id',
        'medico_id'

    ];
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

}
