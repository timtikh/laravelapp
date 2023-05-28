<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);


        $productShow = Permission::create(['name' => 'product.show']);
        $productIndex = Permission::create(['name' => 'product.index']);
        $productCreate = Permission::create(['name' => 'product.create']);
        $productEdit = Permission::create(['name' => 'product.edit']);
        $productDestroy = Permission::create(['name' => 'product.destroy']);

        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo($productShow, $productIndex);



    }


}
