<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create(
            [
                'name'=> 'Boxco',
                'slug'=> 'boxco',
                'lat' => 53.4620,
                'lng' => -2.2493,
                'image_name'=> 'boxco.jpg',
                'address' => '42 Hulme High St, Hulme, Manchester M15 5JP',
                'postcode' => 'M15 5JP',
            ]
        );

        Restaurant::create(
            [
                'name' => 'Latif Grill & Kebabs',
                'slug' => 'latif-grill-kebabs',
                'lat' => 53.4615,
                'lng' => 2.2484,
                'image_name' => 'latif-grill-kebabs.jpg',
                'address' => '381 Stretford Rd, Old Trafford, Stretford, Manchester M15 4AD',
                'postcode' => 'M15 4AD',
            ]);

        Restaurant::create(
            [
                'name' => 'The Wharf',
                'slug' => 'the-wharf',
                'lat' => 53.4745,
                'lng' => -2.2567,
                'image_name' => 'latif-grill-kebabs.jpg',
                'address' => '381 Stretford Rd, Old Trafford, Stretford, Manchester M15 4AD',
                'postcode' => 'M15 4AD',
            ]);
    }
}
