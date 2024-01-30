<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use Spatie\Permission\Models\Role;
 use Spatie\Permission\Models\Permission;
/* use App\Models\Permission;
use App\Models\Role; */
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

        Permission::create(['name'=>'view_citas'])->syncRoles($role1);

         // Creamos el permiso "view-citas"
         /* Permission::insert([
            'name' => 'view-citas',
            'guard_name' => 'api',
        ]);

        // Creamos el permiso "create-citas"
        Permission::insert([
            'name' => 'create-citas',
            'guard_name' => 'api',
        ]);
        Role::insert([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);

        // Creamos el rol "medico"
        Role::insert([
            'name' => 'medico',
            'guard_name' => 'api',
        ]); */
    }
}
