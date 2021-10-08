<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage Users';
        $manageUser->slug = 'manage-users';
        $manageUser->save();

        $manageCategories = new Permission();
        $manageCategories->name = 'Manage Categories';
        $manageCategories->slug = 'manage-categories';
        $manageCategories->save();

        $manageProducts = new Permission();
        $manageProducts->name = 'Manage Products';
        $manageProducts->slug = 'manage-products';
        $manageProducts->save();

        $manageOrders = new Permission();
        $manageOrders->name = 'Manage Orders';
        $manageOrders->slug = 'manage-orders';
        $manageOrders->save();

    }
}
