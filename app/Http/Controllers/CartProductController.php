<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartProductService;
use App\Http\Middleware\CheckIsBuyer;

class CartProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(CheckIsBuyer::class);
    }

    public function store(Request $request){
        $cartproductservice = new CartProductService();
        $cartproductservice->setProduct_id($request["id"]);
        $cartproductservice->setQuantity($request["quantity"]);

        $cartproductservice->create();
        
        return redirect('cart');
    }

    public function get(){
        return redirect('cart');
    }

    public function updateQuantity(Request $request){
        $cartproductservice = new CartProductService();

        $cartproductservice->setProduct_id($request["id"]);
        $cartproductservice->setType($request["type"]);

        $cartproductservice->updateQuantity();
        
        return redirect('cart');
    }

    public function view(){
        $cartproductservice = new CartProductService();
        $products = $cartproductservice->get();

        return view('cart.cart', [
            'products' => $products
        ]);
    }
}
