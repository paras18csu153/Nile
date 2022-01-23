<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function store(Request $request){
        DB::transaction(function ($request) use ($request) {
            $products = json_decode($request['products'], true);
            $user = Auth::user();

            $cart = $user->cart;
            $order = $user->orders()->create([
                'payment_method' => 'default',
                'address' => 'default'
            ]);
    
            foreach($products as $p){
                $p = Product::find($p["id"]);
                $order->products()->attach($p, ['quantity'=> $p->carts()->where('cart_id', $cart->id)->first()->pivot->quantity]);
            }
    
            $cart->products()->detach();
        }, 5);

        return redirect('home');
    }
}
