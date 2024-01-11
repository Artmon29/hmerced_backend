<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medico;
class medicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medico::create([
            'ci'=>'10923377',
            'nombres'=>'Erick',
            'apellidos'=>'Miranda Velasco',
            'direccion'=>'Achumani',
            'email'=>'erick@gmail.com',
            'telefono'=>'61135257',
            'turno'=>'Tarde',
            'especialidad_id'=>'1',
            'user_id'=>'2'
        ]);
    }
}
