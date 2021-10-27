<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::where('slug','administrator')->first();
        $manager = Role::where('slug', 'manager')->first();

        $manageUsers = Permission::where('slug','manage-users')->first();
        $manageCategories = Permission::where('slug','manage-categories')->first();
        $manageProducts = Permission::where('slug','manage-products')->first();
        $manageOrders = Permission::where('slug','manage-orders')->first();

        $user1 = new User();
        $user1->first_name = 'Иван';
        $user1->last_name = 'Иванов';
        $user1->middle_name = 'Иванович';
        $user1->email = 'example@domain.com';
        $user1->password = bcrypt('123456');
        $user1->save();
        $user1->roles()->attach($administrator);
        $user1->permissions()->attach($manageUsers);
        $user1->permissions()->attach($manageCategories);
        $user1->permissions()->attach($manageProducts);
        $user1->permissions()->attach($manageOrders);

        $user2 = new User();
        $user2->first_name = 'Петр';
        $user2->last_name = 'Петров';
        $user2->middle_name = 'Петрович';
        $user2->email = 'petr@gmail.com';
        $user2->password = bcrypt('654321');
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageOrders);

    }
}
