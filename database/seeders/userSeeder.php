<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>'60521613',
            'estado'=>'Activo'
        ])->assignRole('SuperAdmin');
        User::create([
            'name'=>'Erick',
            'username'=>'erick',
            'email'=>'erick@gmail.com',
            'password'=>'123456789',
            'estado'=>'Activo'
        ]);
        User::create([
            'name'=>'Sergio',
            'username'=>'sergio',
            'email'=>'sergio@gmail.com',
            'password'=>'123456789',
            'estado'=>'Activo'

        ]);
    }
}
