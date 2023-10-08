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

    public function displayCartItems(){

        if(auth()->user()) {
             // display cart items
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        //display price
        $price = Cart::where('user_id', Auth::user()->id)->sum('price');

        return view('foods.cart', compact('cartItems', 'price'));

        } else {
            abort('404');

        }

       
        

    }

    public function deletecartItems($id){

        // delete cart items
        $deleteItem = Cart::where('user_id', Auth::user()->id)->where('food_id', $id);

        $deleteItem->delete();

       

        if ($deleteItem) {
            return redirect()->route('food.display.cart')->with([ 'delete' => 'Item deleted from cart succesffuly.' ]);
        }        

    }
    
}
