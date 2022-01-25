<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        User::factory(1)->state([
            'name' => 'Admin',
            'email' => 'admin@larashop.com',
            'is_admin' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->create();
        User::factory(10)->create();
        Address::factory(13)->create();
        Category::factory(10)->create();
        Product::factory(37)->create();
    }
}
