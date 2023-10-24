<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalMedico extends Model
{
    use HasFactory;
    protected $fillable=[
        'ci',
        'nombres',
        'apellidos',
        'direccion',
        'email',
        'telefono',
        'user_id'
    ];
}
