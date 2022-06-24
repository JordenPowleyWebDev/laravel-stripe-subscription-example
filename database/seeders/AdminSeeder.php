<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class AdminSeeder
 */
class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->fill([
            'first_name'        => "Jorden",
            'last_name'         => "Powley",
            'email'             => "jorden.powley.webdev@gmail.com",
            'email_verified_at' => now(),
            'password'          => bcrypt('adminPassword')
        ]);
        $admin->save();

        $admin->save();
        $admin->assignRole(UserRoles::SUPER_ADMIN);
    }
}
