<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request) {
        $userLocationLat = $request->input('latitude');
        $userLocationLng = $request->input('longitude');
        $distance = $request->input('distance');

        $availableRestaurants = [];
        foreach (Restaurant::all() as $restaurant) {
            $distanceBetweenLocations = $this->getDistance($restaurant->lat, $restaurant->lng, $userLocationLat, $userLocationLng);
            if($distanceBetweenLocations <= $distance) {
                $availableRestaurants[] = $restaurant;
            }
        }

        return view('restaurants', [
            'restaurants' => $availableRestaurants
        ]);
    }

    private function getDistance($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'mi', $decimals = 2) {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }

}
