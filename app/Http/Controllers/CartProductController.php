<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckIsBuyer;
use App\Models\CartProduct;
use Auth;

class CartProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(CheckIsBuyer::class);
    }

    public function store(Request $request){
        $cartProduct = new CartProduct();
        $cartproduct["productId"] = $request["id"];
        $cartproduct["quantity"] = 1;

        $user = Auth::user();

        $cartProduct->create($cartproduct, $user);
        
        return redirect('cart');
    }

    public function get(){
        return redirect('cart');
    }

    public function updateQuantity(Request $request){
        $cartProduct = new CartProduct();
        $user = Auth::user();

        $cartproduct["productId"] = $request["id"];
        $cartproduct["type"] = $request["type"];

        $cartProduct->updateQuantity($cartproduct, $user);
        
        return redirect('cart');
    }

    public function view(){
        $cartProduct = new CartProduct();
        $cart = Auth::user()->cart;
        $products = $cart->products()->get();

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
