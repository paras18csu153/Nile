<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function store(Request $request){
        $cartService = new CartService();

        $cartService->create();

        return redirect('/home');
    }
}
