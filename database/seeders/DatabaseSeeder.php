<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BankSeeder;
use Database\Seeders\RekeningAdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call([
            BankSeeder::class,
            RekeningAdminSeeder::class,
            UserSeeder::class,
        ]);
        
    }
}