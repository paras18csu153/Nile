<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartProductService;

class CartProductController extends Controller
{
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
