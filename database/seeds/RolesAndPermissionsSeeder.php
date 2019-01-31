<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name'=>'browse request']);
        Permission::create(['name'=>'create request']);
        Permission::create(['name'=>'edit request']);
        Permission::create(['name'=>'delete request']);
        
        Permission::create(['name'=>'browse incident']);
        Permission::create(['name'=>'create incident']);
        Permission::create(['name'=>'edit incident']);
        Permission::create(['name'=>'delete incident']);
        Permission::create(['name'=>'employee incident']);

        /*maste*/
        Permission::create(['name'=>'crud stages']);
        Permission::create(['name'=>'crud statuses']);
        Permission::create(['name'=>'crud services']);

        /*approval*/
        Permission::create(['name'=>'boss approval']);
        Permission::create(['name'=>'operation approval']);
        Permission::create(['name'=>'servicedesk update']);

        /*Service Owner*/
        Permission::create(['name'=>'so approval']);
        
        /*Role employee*/
        $role = Role::create(['name'=>'employee'])
            ->givePermissionTo([
                'browse request',
                'create request',
                'edit request',
                'delete request',
                'browse incident',
                'create incident',
                'edit incident',
                'delete incident',
                'employee incident',
            ]);

        /*Role service desk*/
        $role = Role::create(['name'=>'servicedesk'])
            ->givePermissionTo([
                'crud stages',
                'crud statuses',
                'crud services',
                'servicedesk update',
            ]);
        
        /*Role Atasan/boss*/
        $role = Role::create(['name'=>'boss'])
            ->givePermissionTo([
                'boss approval',
            ]);
        
        /*Role ICT */
        $role = Role::create(['name'=>'operation'])
            ->givePermissionTo([
                'operation approval',
            ]);
        
        /*Role SO */
        $role = Role::create(['name'=>'so'])
            ->givePermissionTo([
                'so approval',
            ]);
        
    }
}
