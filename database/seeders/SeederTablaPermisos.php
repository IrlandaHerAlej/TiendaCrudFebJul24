<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisos= [
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //tabla clientes
            'ver-clientes',
            'crear-clientes',
            'editar-clientes', 
            'borrar-clientes',
            //tabla usuarios
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios', 
            'borrar-usuarios',
            //tabla facturas
            'ver-facturas',
            'crear-facturas',
            'editar-facturas', 
            'borrar-facturas',
            //tabla perfiles
            'ver-perfiles',
            'crear-perfiles',
            'editar-perfiles', 
            'borrar-perfiles',

        ];

        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
