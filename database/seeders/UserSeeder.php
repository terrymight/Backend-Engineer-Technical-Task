<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $basicRole = Role::where('name', 'Basic User')->first();

        /**
         * Create Super Admin (only one)
         */
        $superAdmin = User::factory()->create([
            'email' => 'johndoe@yahoo.com',
        ]);

        $superAdmin->roles()->attach($superAdminRole->id);

        /**
         * Create Admin users (e.g. 5)
         */
        User::factory(5)->create()->each(function ($user) use ($adminRole) {
            $user->roles()->attach($adminRole->id);
        });

        /**
         * Create Basic users (remaining 14)
         */
        User::factory(14)->create()->each(function ($user) use ($basicRole) {
            $user->roles()->attach($basicRole->id);
        });
    }
}
