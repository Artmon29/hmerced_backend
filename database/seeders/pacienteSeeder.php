<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;
class pacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::create([
            'ci'=>'10923378',
            'nombres'=>'Sergio Franco',
            'apellidos'=>'Vargas Limachi',
            'direccion'=>'Plaza Ergueta',
            'rfid'=>'f18d141c',
            'user_id'=>'3'
        ]);
    }
}
