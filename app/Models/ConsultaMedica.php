<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaMedica extends Model
{
    use HasFactory;
    protected $fillable=[
        'cita_id',
        'diagnostico',
        'prescripcion',
        'notas'
    ];
}
