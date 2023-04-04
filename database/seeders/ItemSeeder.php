<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tints = [
            [
                'title' => 'Blue'
            ], [
                'title' => 'Red'
            ], [
                'title' => 'Yellow'
            ], [
                'title' => 'Green'
            ], [
                'title' => 'Pink'
            ], [
                'title' => 'Gray'
            ], [
                'title' => 'Dark Blue'
            ], [
                'title' => 'Dark Green'
            ], [
                'title' => 'Dark Amber'
            ], [
                'title' => 'Brown'
            ]
        ];

        $categories = [
            [
                'title' => 'Lens',
                'description' => 'Lens Description',
                'color' => 'white',
                'bgcolor' => 'primary',
                'hex' => '#6c757d'
            ], [
                'title' => 'Frame',
                'description' => 'Frame Description',
                'color' => 'white',
                'bgcolor' => 'success',
                'hex' => '#198754'
            ], [
                'title' => 'Accessory',
                'description' => 'Accessory Description',
                'color' => 'white',
                'bgcolor' => 'danger',
                'hex' => '#dc3545'
            ]
        ];

        foreach ($categories as $c) {
            \App\Models\Category::firstOrCreate([
                'title' => $c['title'],
                'description' => $c['description'],
                'color' => $c['color'],
                'bgcolor' => $c['bgcolor'],
                'hex' => $c['hex']
            ]);
        }

        foreach ($tints as $tint) {
            \App\Models\Tint::firstOrCreate([
                'title' => $tint['title']
            ]);
        }

        \App\Models\Item::factory()->count(10)->create();
    }
}
