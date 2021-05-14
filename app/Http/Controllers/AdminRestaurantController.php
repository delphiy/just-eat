<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'postcode' => 'required',
            'address' => 'required',
            'restaurant_image' => 'required',
        ]);

        $image = $request->file('restaurant_image');
        $name = Str::slug($request->input('name')). '_' . time();
        $filePath = $name. '.' . $image->getClientOriginalExtension();
        $request->restaurant_image->move(public_path('images'), $filePath);

        Restaurant::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'lat' => $request->input('latitude'),
            'lng' => $request->input('longitude'),
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
            'image_name' => $filePath,
        ]);

        return redirect()->route('restaurant.index')->with('success', 'Restaurant added successfully');
    }

    public function edit(Request $request, Restaurant $restaurant) {
        return view('admin.restaurant.create', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant) {
        $restaurant->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'lat' => $request->input('latitude'),
            'lng' => $request->input('longitude'),
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('restaurant.index')->with('success', 'Restaurant updated successfully');
    }

    public function destroy(Restaurant $restaurant) {
        $restaurant->delete();

        return redirect()->route('restaurant.index')->with('success', 'Restaurant deleted successfully');
    }
}
