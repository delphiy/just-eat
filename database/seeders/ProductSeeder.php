<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'name' => 'Check Mandi',
                'slug' => 'lamb-kabsa',
                'description' => 'Three pieces of lamb with big portion of rice.',
                'image_name' => '002.png',
                'price' => 7.99,
                'sale_price' => 0.00,
                'restaurant_id' => 1
            ]);

        Product::create(
            [
                'name' => 'Nice Meal',
                'slug' => 'nice-meal',
                'description' => 'Three pieces of lamb with big portion of rice.',
                'image_name' => 'oo1.png',
                'price' => 7.99,
                'sale_price' => 0.00,
                'restaurant_id' => 1
            ]);

        Product::create(
            [
                'name' => 'Fish',
                'slug' => 'fish',
                'description' => 'Three pieces of lamb with big portion of rice.',
                'image_name' => '003.png',
                'price' => 12.99,
                'sale_price' => 0.00,
                'restaurant_id' => 1
            ]);

        Product::create(
            [
                'name' => 'Check Mandi',
                'slug' => 'lamb-kabsa',
                'description' => 'Three pieces of lamb with big portion of rice.',
                'image_name' => '002.png',
                'price' => 7.99,
                'sale_price' => 0.00,
                'restaurant_id' => 1
            ]);
    }
}
