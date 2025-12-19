<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ResetRbacSeeder extends Seeder
{
    /**
     * Truncate tables
     * php artisan db:seed --class=ResetRbacSeeder
     * 
     */
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE role_permission RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE role_user RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE permissions RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE roles RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE users RESTART IDENTITY CASCADE');
    }
}
