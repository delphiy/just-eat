<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $baskets = Basket::where('user_id', auth()->user()->id)->with('product')->get();

        return view('basket', compact('baskets')); //
    }

    public function store(Request $request) {
        $currentUser = auth()->user();
        $userID = $currentUser->id;
        $productID = $request->product_id;
        $qty = 1;
        $product = Product::find($productID)->first();

        $basket = Basket::where('product_id', $productID)->where('user_id', $userID)->first();

        if(!$basket) {
            Basket::create([
                'product_id' => $productID,
                'user_id' => $userID,
                'qty' => $qty,
                'price' => $product->price,
            ]);
        } else {
            $basket->qty += 1;
            $basket->price += $product->price;
            $basket->save();
        }

        $basketCount = Basket::where('user_id', $userID)->sum('qty');

        return response()->json([
            "basket_count" => $basketCount,
            200
        ]);
    }
}
