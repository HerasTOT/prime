<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PERMISOS DE MODULOS DEL SISTEMA
        Permission::create(['name' => 'modulo.seguridad', 'guard_name' => 'web', 'description' => 'Administración de Seguridad', 'module_key' => 'seguridad']);
        // Permission::create(['name' => 'modulo.catalogos', 'guard_name' => 'web', 'description' => 'Administración catálogos', 'module_key' => 'cat']);

        // PERMISOS DE SEGURIDAD
        Permission::create(['name' => 'module.index', 'guard_name' => 'web', 'description' => 'Leer Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'module.store', 'guard_name' => 'web', 'description' => 'Crear Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'module.update', 'guard_name' => 'web', 'description' => 'Actualizar Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'module.delete', 'guard_name' => 'web', 'description' => 'Eliminar Registros', 'module_key' => 'seguridad']);

        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web', 'description' => 'Leer Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'permissions.store', 'guard_name' => 'web', 'description' => 'Crear Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'permissions.update', 'guard_name' => 'web', 'description' => 'Actualizar Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'permissions.delete', 'guard_name' => 'web', 'description' => 'Eliminar Registros', 'module_key' => 'seguridad']);

        Permission::create(['name' => 'perfiles.index', 'guard_name' => 'web', 'description' => 'Leer Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'perfiles.store', 'guard_name' => 'web', 'description' => 'Crear Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'perfiles.update', 'guard_name' => 'web', 'description' => 'Actualizar Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'perfiles.delete', 'guard_name' => 'web', 'description' => 'Eliminar Registros', 'module_key' => 'seguridad']);

        Permission::create(['name' => 'user.index', 'guard_name' => 'web', 'description' => 'Leer Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'user.store', 'guard_name' => 'web', 'description' => 'Crear Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'user.update', 'guard_name' => 'web', 'description' => 'Actualizar Registros', 'module_key' => 'seguridad']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'web', 'description' => 'Eliminar Registros', 'module_key' => 'seguridad']);

    }
}
