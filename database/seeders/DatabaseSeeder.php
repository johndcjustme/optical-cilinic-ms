<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\User::firstOrCreate([
            'name' => 'John Dc',
            'email' => 'john@test.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            SupplierSeeder::class,
            ItemSeeder::class,
            RolesAndPermissionsSeeder::class,   
        ]);
    }
}
