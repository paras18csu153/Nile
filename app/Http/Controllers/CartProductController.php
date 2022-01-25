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
        $cartproduct["productId"] = $request["id"];
        $cartproduct["quantity"] = $request["quantity"];

        $cartproductservice->create($cartproduct);
        
        return redirect('cart');
    }

    public function get(){
        return redirect('cart');
    }

    public function updateQuantity(Request $request){
        $cartproductservice = new CartProductService();

        $cartproduct["productId"] = $request["id"];
        $cartproduct["type"] = $request["type"];

        $cartproductservice->updateQuantity($cartproduct);
        
        return redirect('cart');
    }

    public function view(){
        $cartproductservice = new CartProductService();
        $products = $cartproductservice->get();

        $total = 0;

        foreach($products as $product){
            $total = $total + (($product->price)*($product['pivot']['quantity']));
        }

        return view('cart.cart', [
            'products' => $products,
            'total' => $total
        ]);
    }
}
