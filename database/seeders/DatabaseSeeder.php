<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CommonSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        //$this->call(CatalogSeeder::class);
        //$this->call(OrderSeeder::class);
    }
}
