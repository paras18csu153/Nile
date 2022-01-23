<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function store(Request $request){
        $products = json_decode($request['products'], true);
        Auth::user()->orders()->create([
            'payment_method' => 'default',
            'address' => 'default'
        ]);

        return redirect('home');
    }
}
