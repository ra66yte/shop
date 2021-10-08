<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->first_name = 'Василий';
        $user1->last_name = 'Васильев';
        $user1->middle_name = 'Василиевич';
        $user1->email = 'vas@domain.com';
        $user1->password = bcrypt('123456');
        $user1->save();
    }
}
