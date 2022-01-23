<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function store(Request $request){
        $products = json_decode($request['products'], true);
        $user = Auth::user();

        $cart = $user->cart;
        $cart->products()->detach();

        $user->orders()->create([
            'payment_method' => 'default',
            'address' => 'default'
        ]);

        return redirect('home');
    }
}
