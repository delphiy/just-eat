<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $restaurant = Restaurant::where('slug', $request->slug)->first();

        return view('products', [
            "products" => $restaurant->products,
            "restaurant" => $restaurant,
        ]);
    }
}
