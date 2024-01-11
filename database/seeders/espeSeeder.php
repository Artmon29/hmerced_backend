<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especialidad;
class espeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialidad::create([
            'nombres'=>'traumatologia',
            'descripcion'=>'rama de la Medicina que se dedica al estudio y tratamiento de las lesiones traumáticas que afectan al sistema músculo-esquelético'
        ]);
        Especialidad::create([
            'nombres'=>'ginecologia',
            'descripcion'=>'especialidad de la medicina que se centra en el estudio del sistema reproductor femenino'
        ]);
    }
}
