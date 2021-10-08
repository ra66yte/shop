<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Администратор';
        $admin->slug = 'administrator';
        $admin->save();

        $manager = new Role();
        $manager->name = 'Менеджер';
        $manager->slug = 'manager';
        $manager->save();
    }
}
