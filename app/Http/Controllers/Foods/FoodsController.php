<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Cart;
class FoodsController extends Controller
{
    //

    public function foodDetails($id){
        $foodItem = Food::find($id);
        return view('foods.food-details', compact('foodItem'));
        

    }

    public function cart(Request $request, $id){
        $cart = Cart::create([
            "user_id" => $request->user_id,
            "food_id" => $request->food_id,
            "name" => $request->name,
            "image" => $request->image,
            "image" => $request->image,
            "price" => $request->price,
        ]);

        echo "item added to cart succesfully";
        //return view('foods.food-details', compact('foodItem'));
        

    }

    
}
