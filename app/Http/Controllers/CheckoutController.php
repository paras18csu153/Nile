<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function store(Request $request){
        $order = new Order();

        $order->create($request);

        return redirect('home');
    }
}
