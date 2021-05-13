<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminRestaurantController extends Controller
{
    public function index() {
        return view('admin.restaurant.index' , [
            "restaurants" => Restaurant::all()
        ]);
    }

    public function create() {
        $restaurant = new Restaurant();

        return view('admin.restaurant.create', compact('restaurant'));
    }

    public function store(Request $request) {
        dd('store');
    }
}
