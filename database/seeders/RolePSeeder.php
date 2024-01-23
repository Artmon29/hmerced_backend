<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'SuperAdmin']);
        $role2 = Role::create(['name'=>'Admin']);
        $role3 = Role::create(['name'=>'Medico']);
        $role4 = Role::create(['name'=>'Personal']);
        $role5 = Role::create(['name'=>'Paciente']);
        $role6 = Role::create(['name'=>'Supervisor']);

        Permission::create(['name'=>'']);
    }
}
