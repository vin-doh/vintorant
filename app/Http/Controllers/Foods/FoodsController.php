<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Cart;
use Auth;
class FoodsController extends Controller
{
    //

    public function foodDetails($id){
        $foodItem = Food::find($id);

        //verifying if user added item to cart
        $cartVerifying = Cart::where('food_id', $id)->where('user_id', Auth::user()->id)->count();
        return view('foods.food-details', compact('foodItem', 'cartVerifying'));
        

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

        if ($cart) {
            return redirect()->route('food.details', $id)->with([ 'success' => 'Item added to cart succesffuly.' ]);
        }
        //return view('foods.food-details', compact('foodItem'));
        

    }

    
}
