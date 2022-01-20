<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Middleware\CheckIsBuyer;

class CartController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(CheckIsBuyer::class);
    }

    public function store(Request $request){
        $cartService = new CartService();

        $cartService->create();

        return redirect('/cart');
    }
}
