<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckIsBuyer;

use App\Models\Cart;

class CartController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(CheckIsBuyer::class);
    }

    public function store(Request $request){
        $cart = new Cart();
        $user = Auth::user();

        $cart->create($user);

        return redirect('/cart');
    }
}
