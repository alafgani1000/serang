<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        $roleEmployee = Role::create(['name' => 'empolyee']);
        $roleSd = Role::create(['name' => 'service desk']);
        $boss = Role::create(['name' => 'boss']);
        $opertaionSd = Role::create(['name' => 'operation sd']);
        $roleMesFlat = Role::create(['name' => 'so mes flat']);
        $roleWeb = Role::create(['name' => 'so web']);
        $roleMesLong = Role::create(['name' => 'so mes long']);
        $roleSapHr = Role::create(['name' => 'so sap hr']);
        $roleSapPp = Role::create(['name' => 'so sap pp']);
        $operationict = Role::create(['name' => 'operation ict']);
        $roleSapFi = Role::create(['name' => 'so sap fi']);
        $roleSapCo = Role::create(['name' => 'so sap co']);
        $roleSapSd = Role::create(['name' => 'so sap sd']);
        $roleSapIm = Role::create(['name' => 'so mes im']);
        $roleSapMm = Role::create(['name' => 'so mes mm']);
        $roleSapPs = Role::create(['name' => 'so mes ps']);

        Permission::create(['name' => 'browse request']);
        Permission::create(['name' => 'create request']);
        Permission::create(['name' => 'edit request']);
        Permission::create(['name' => 'delete request']);

        Permission::create(['name' => 'browse incident']);
        Permission::create(['name' => 'create incident']);
        Permission::create(['name' => 'edit incident']);
        Permission::create(['name' => 'delete incident']);
        Permission::create(['name' => 'employee incident']);

        /*maste*/
        Permission::create(['name' => 'crud stages']);
        Permission::create(['name' => 'crud statuses']);
        Permission::create(['name' => 'crud services']);

        /*approval*/
        Permission::create(['name' => 'boss approval']);
        Permission::create(['name' => 'operation approval']);
        Permission::create(['name' => 'servicedesk update']);

        /*Service Owner*/
        Permission::create(['name' => 'so approval']);

        /*Role employee*/

        $perEmployee = [
            'browse request',
            'create request',
            'edit request',
            'delete request',
            'browse incident',
            'create incident',
            'edit incident',
            'delete incident',
            'employee incident',
        ];

        $perSo = [
            'so approval',
        ];

        $perServicedesk = [
            'crud stages',
            'crud statuses',
            'crud services',
            'servicedesk update',
        ];

        $perBoss = [
            'boss approval',
        ];

        $perOperation = [
            'operation approval',
        ];

        $roleEmployee->givePermissionTo($perEmployee);

        $roleMesLong->givePermissionTo($perSo);

        $roleMesFlat->givePermissionTo($perSo);

        $roleSapCo->givePermissionTo($perSo);

        $roleSapFi->givePermissionTo($perSo);

        $roleSapHr->givePermissionTo($perSo);

        $roleSapIm->givePermissionTo($perSo);

        $roleSapPp->givePermissionTo($perSo);

        $roleSapPs->givePermissionTo($perSo);

        $roleSapSd->givePermissionTo($perSo);

        $roleSd->givePermissionTo($perServicedesk);

        $roleWeb->givePermissionTo($perSo);

        $boss->givePermissionTo($perBoss);

        $opertaionSd->givePermissionTo($perOperation);

        $operationict->givePermissionTo($perOperation);
    }
}
